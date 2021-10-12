<?php

namespace App\Services\Api\User\Manager;

use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Classes\Enum\Api\User\UserStatusEnum;
use App\Contracts\Parser\ParserInterface;
use App\Models\Department;
use App\Models\User;
use App\Services\Api\Parser\ParserService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class ManagerService extends ParserService implements ParserInterface
{
    /**
     * Парсинг зав отделений
     *
     * @param $url
     */
    public function parse($url)
    {
        $html = $this->getHtml($url);

        $crawler = new Crawler($html);

        $managerData = $this->parseManagerData($crawler);

        $managerDepartmentData = Arr::get($managerData, 'managerDepartmentData');

        $manager = $this->createManager($managerData);

        if (!empty($managerDepartmentData) && $manager) {
            $this->createManagerDepartment($manager, $managerDepartmentData);
        } else {
            \Log::info(['Ошибка парсера' => 'Не найдена информация о отделении заведующего на: ' . $url]);
        }
    }

    /**
     * Парсинг данных
     *
     * @param Crawler $crawler
     * @return array
     */
    public function parseManagerData(Crawler $crawler)
    {
        $managerDepartmentDescription = $crawler->filter('.czr-wp-the-content > p')->text();

        $managerToolbar = $crawler->filter('.sek-row.sek-sektion-inner');

        $managerInfoSection = $managerToolbar->filter('.sek-column.sek-col-base.sek-col-33 > div > div');

        /** @var $managerName */
        $managerName = $managerInfoSection->filter('h5')->text();
        $managerName = Str::title(Str::lower($managerName));

        /** @var $managerDepartment */
        $managerDepartmentData = $managerInfoSection->filter('p > em')->each(function ($node) {
            return $pages[] = $node->text();
        });

        /** @var  $managerAvatar */
        $managerAvatar = $crawler->filter('.sek-link-to-img-lightbox')->each(function ($i) {
            return $i->attr('href');
        });

        return [
            'managerName' => $managerName,
            'managerAvatar' => $managerAvatar,
            'managerDepartmentData' => array_merge($managerDepartmentData, ['managerDepartmentDescription' => $managerDepartmentDescription]),
        ];
    }

    /**
     * Создание мэнеджера
     *
     * @param array $managerData
     * @return mixed
     */
    public function createManager(array $managerData)
    {
        $managerName = Arr::get($managerData, 'managerName');
        $managerAvatar = Arr::get($managerData, 'managerAvatar');

        if (!$manager = User::where('name', $managerName)->first()) {
            /** @var  $manager */
            $manager = User::create([
                'name' => $managerName,
                'password' => Hash::make(Str::random(24)),
                'role' => UserRoleEnum::MANAGER,
                'status' => UserStatusEnum::ACTIVE,
                'avatar' => $managerAvatar ? $managerAvatar[0] : null,
                'is_consent_privacy_policy' => true,
                'is_consent_terms_of_use' => true
            ]);
        }

        return $manager;
    }

    /**
     * Создание отделения
     *
     * @param User $manager
     * @param array $managerDepartmentData
     */
    public function createManagerDepartment(User $manager, array $managerDepartmentData)
    {
        if (array_key_exists(1, $managerDepartmentData)) {
            $managerDepartmentName = $managerDepartmentData[1];
        } else {
            $managerDepartmentName = explode('«', $managerDepartmentData[0]);
            $managerDepartmentName = '«'.$managerDepartmentName[1];
        }

        $managerDepartment = Department::where('name', 'Like', "%{$managerDepartmentName}%")->first();

        if (!$managerDepartment && $managerDepartmentName) {
            Department::create([
                'name' => $managerDepartmentName,
                'description' => Arr::get($managerDepartmentData, 'managerDepartmentDescription', ''),
                'manager_id' => $manager->id
            ]);
        } else {
            \Log::info(['Ошибка парсера' => 'Не найдено название отделении заведующего']);
        }
    }
}

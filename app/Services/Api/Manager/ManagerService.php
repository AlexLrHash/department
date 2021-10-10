<?php

namespace App\Services\Api\Manager;

use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Classes\Enum\Api\User\UserStatusEnum;
use App\Contracts\Parser\ParserInterface;
use App\Models\Department;
use App\Models\User;
use App\Services\Api\Parser\ParserService;
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
        $managerToolbar = $crawler->filter('.sek-row.sek-sektion-inner');

        $managerInfoSection = $managerToolbar->filter('.sek-column.sek-col-base.sek-col-33 > div > div');

        /** @var $managerName */
        $managerName = $managerInfoSection->filter('h5')->text();
        $managerName = Str::title(Str::lower($managerName));

        /** @var $managerDepartment */
        $managerInfoData = $managerInfoSection->filter('p > em')->each(function ($node) {
            return $pages[] = $node->text();
        });

        $managerDepartmentName = $managerInfoData[1];

        $managerDepartment = Department::where('name', 'Like', "%{$managerDepartmentName}%")->first();

        /** @var  $managerAvatar */
        $managerAvatar = $crawler->filter('.sek-link-to-img-lightbox')->each(function ($i) {
            return $i->attr('href');
        });

        if (!$manager = User::where('name', $managerName)->first()) {
            $manager = User::create([
                'name' => $managerName,
                'password' => Hash::make(Str::random(24)),
                'role' => UserRoleEnum::MANAGER,
                'email' => 'vitgtk@gmail.com',
                'status' => UserStatusEnum::ACTIVE,
                'avatar' => $managerAvatar ? $managerAvatar[0] : null,
                'is_consent_privacy_policy' => true,
                'is_consent_terms_of_use' => true
            ]);
        }

        if (!$managerDepartment) {
            Department::create([
                'name' => $managerDepartmentName,
                'manager_id' => $manager->id
            ]);
        }
    }
}

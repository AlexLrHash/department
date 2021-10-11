<?php

namespace App\Services\Api\User\Teacher;

use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Classes\Enum\Api\User\UserStatusEnum;
use App\Contracts\Parser\ParserInterface;
use App\Models\User;
use App\Services\Api\Parser\ParserService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class TeacherService extends ParserService implements ParserInterface
{
    /**
     * Парсинг данных о преподавателе
     *
     * @param $url
     */
    public function parse($url)
    {
        $html = $this->getHtml($url);

        $crawler = new Crawler($html);
        $teacherToolbar = $crawler->filter('.czr-gallery.row.flex-row.czr-gallery-style.gallery.galleryid-305.gallery-columns-6.gallery-size-thumbnail');

        $teacherNames = $teacherToolbar->filter('.wp-caption-text.gallery-caption')->each(function ($node) {
            return $pages[] = $node->text();
        });

        $teacherAvatars = $teacherToolbar->filter('.attachment-thumbnail.size-thumbnail')->each(function ($node) {
            return $node->attr('src');
        });

        for ($i = 0; $i < count($teacherNames); $i++) {
            $this->createUser([
                'teacherName' => $teacherNames[$i],
                'teacherAvatar' => $teacherAvatars[$i]
            ]);
        }
    }

    /**
     * Создание преподавателя
     *
     * @param array $teacherData
     */
    public function createUser(array $teacherData = [])
    {
        User::create([
            'name' => Arr::get($teacherData, 'teacherName'),
            'role' => UserRoleEnum::TEACHER,
            'password' => Hash::make(Str::random(24)),
            'status' => UserStatusEnum::NEW,
            'avatar' => Arr::get($teacherData, 'teacherAvatar'),
            'is_consent_privacy_policy' => true,
            'is_consent_terms_of_use' => true
        ]);
    }
}

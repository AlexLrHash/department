<?php

namespace Database\Seeders;

use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createSuperUser();
    }

    /**
     * Создаем Супер пользователя
     */
    public function createSuperUser()
    {
        try {
            User::create([
                'email' => 'ryzhakovalexeynicol@gmail.com',
                'password' => Hash::make('secret'),
                'name' => 'SuperUser',
                'role' => UserRoleEnum::ADMIN,
            ]);
        } catch (\Exception $e) {
            \Log::warning($e);
        }
    }
}

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
        $this->createManagers();
        $this->createTeachers();
        $this->createSuperUser();
    }

    /**
     * Создание преподавателей
     */
    public function createTeachers()
    {
        User::factory()->count(5)->create([
            'role' => UserRoleEnum::TEACHER,
            'department_id' => rand(0, 2)
        ]);
    }

    /**
     * Создание зав отделениями
     */
    public function createManagers()
    {
        User::factory()->count(5)->create([
            'role' => UserRoleEnum::MANAGER,
            'department_id' => rand(0, 2)
        ]);
    }

    /**
     * Создаем Супер пользователя
     */
    public function createSuperUser()
    {
        User::create([
            'email' => 'ryzhakovalexeynicol@gmail.com',
            'password' => Hash::make('secret'),
            'name' => 'SuperUser',
            'role' => UserRoleEnum::ADMIN,
            'department_id' => 2
        ]);
    }
}

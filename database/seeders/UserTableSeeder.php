<?php

namespace Database\Seeders;

use App\Classes\Enum\UserStatusEnum;
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
    }

    public function createTeachers()
    {
        User::create([
            'name' => 'Анастасия',
            'email' => 'superuser@gmail.com',
            'password' => Hash::make('secret'),
            'department_id' => 1,
            'status' => UserStatusEnum::TEACHER
        ]);
    }

    public function createManagers()
    {
        User::create([
            'name' => 'Алексей',
            'email' => 'ryzhakovalexeynicol@gmail.com',
            'password' => Hash::make('secret'),
            'department_id' => 1,
            'status' => UserStatusEnum::MANAGER
        ]);
    }
}

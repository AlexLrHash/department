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
    #TODO factory
    public function createTeachers()
    {
        User::factory()->count(5)->create([
            'status' => UserStatusEnum::TEACHER,
            'department_id' => rand(0, 2)
        ]);
    }

    public function createManagers()
    {
        User::factory()->count(5)->create([
            'status' => UserStatusEnum::MANAGER,
            'department_id' => rand(0, 2)
        ]);
    }
}

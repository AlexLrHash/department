<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'Лесники',
            'manager_id' => 2
        ]);

        Department::create([
            'name' => 'Информационные технологии',
            'manager_id' => 2
        ]);
    }
}

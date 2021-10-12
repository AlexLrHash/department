<?php

namespace Database\Seeders;

use App\Models\Discipline;
use Illuminate\Database\Seeder;

class DisciplineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discipline::create([
           'name' => 'Резка по дереву',
            'department_id' => 4
        ]);

        Discipline::create([
            'name' => 'ТРПО',
            'department_id' => 1
        ]);
    }
}

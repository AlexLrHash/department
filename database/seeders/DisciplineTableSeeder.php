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
        ]);

        Discipline::create([
            'name' => 'ТРПО',
        ]);
    }
}

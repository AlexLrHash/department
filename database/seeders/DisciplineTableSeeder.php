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
           'number_of_labs' => 123,
           'number_of_practices' => 123
        ]);
    }
}

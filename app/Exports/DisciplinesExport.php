<?php

namespace App\Exports;

use App\Models\Discipline;
use Maatwebsite\Excel\Concerns\FromCollection;

class DisciplinesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Discipline::get();
    }
}

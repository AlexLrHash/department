<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Discipline;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class DisciplinesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Discipline|null
     */
    public function model(array $row)
    {
        return new Discipline([
            'name'  => $row[0],
            'description' => $row[1],
            'department_id' => Department::where('name', $row[2])->firstOrFail()->id,
            'background' => $row[3],
        ]);
    }
}

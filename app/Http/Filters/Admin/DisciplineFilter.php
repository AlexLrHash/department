<?php

namespace App\Http\Filters\Admin;

use App\Classes\Enum\Api\Discipline\DisciplineFilterValues;
use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class DisciplineFilter extends AbstractFilter
{
    /**
     * Get Callbacks
     *
     * @return array[]
     */
    public function getCallbacks(): array
    {
        return [
            DisciplineFilterValues::NAME => [$this, 'name'],
            DisciplineFilterValues::TEACHER => [$this, 'teacher']
        ];
    }

    /**
     * Name
     *
     * @param Builder $builder
     * @param $value
     */
    public function name(Builder $builder, $value)
    {
        $builder->where('name', 'like', "%{$value}%");
    }

    /**
     * Teacher
     *
     * @param Builder $builder
     * @param $value
     */
    public function teacher(Builder $builder, $value)
    {
        $builder->whereHas('teachers', function ($query) use ($value) {
           $query->where('name', 'like', "%{$value}%");
        });
    }
}

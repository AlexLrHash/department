<?php

namespace App\Http\Filters\Admin;

use App\Classes\Enum\Api\Department\DepartmentFilterValues;
use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class DepartmentFilter extends AbstractFilter
{
    /**
     * Get Callbacks
     *
     * @return array
     */
    public function getCallbacks(): array
    {
        return [
            DepartmentFilterValues::NAME => [$this, 'name'],
            DepartmentFilterValues::MANAGER => [$this, 'manager']
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
        $builder->where("name", 'like', "%{$value}%");
    }

    /**
     * Manager
     *
     * @param Builder $builder
     * @param $value
     */
    public function manager(Builder $builder, $value)
    {
        $builder->whereHas('manager', function ($query) use ($value) {
            $query->where('name', 'like', "%{$value}%");
        });
    }
}

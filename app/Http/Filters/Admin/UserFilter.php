<?php

namespace App\Http\Filters\Admin;

use App\Classes\Enum\Api\User\UserFilterValues;
use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter
{
    /**
     * All Names and their functions
     *
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [
            UserFilterValues::NAME => [$this, 'name'],
            UserFilterValues::EMAIL => [$this, 'email'],
            UserFilterValues::ROLE => [$this, 'role']
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
     * Email
     *
     * @param Builder $builder
     * @param $value
     */
    public function email(Builder $builder, $value)
    {
        $builder->where('email', 'like', "%{$value}%");
    }

    /**
     * Role
     *
     * @param Builder $builder
     * @param $value
     */
    public function role(Builder $builder, $value)
    {
        $builder->where('role', $value);
    }
}

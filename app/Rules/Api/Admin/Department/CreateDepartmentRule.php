<?php

namespace App\Rules\Api\Admin\Department;

use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Classes\Enum\Api\User\UserStatusEnum;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CreateDepartmentRule implements Rule
{
    private $error;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::where('second_id', $value)->first();
        if ($user) {
            if ($user->role == UserRoleEnum::MANAGER) {
                return true;
            } else {
                $this->error = 'Выбран не мэнэджер';
            }
        } else {
            $this->error = 'Выбран несуществующий пользователь';
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->error;
    }
}

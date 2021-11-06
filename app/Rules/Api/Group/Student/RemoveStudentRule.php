<?php

namespace App\Rules\Api\Group\Student;

use App\Classes\Enum\Api\User\Param\Student\StudentParamNameEnum;
use App\Models\UserParam;
use Illuminate\Contracts\Validation\Rule;

class RemoveStudentRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return UserParam::where('name', StudentParamNameEnum::STUDENT_ID)->where('value', $value)->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

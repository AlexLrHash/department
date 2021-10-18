<?php

namespace App\Rules\Api\User\Student;

use App\Classes\Enum\Api\User\Param\Student\StudentParamNameEnum;
use App\Classes\Enum\Api\User\Param\Student\StudentParamTypeEnum;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class UpdateStudentParamRule implements Rule
{
    protected $errors;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->errors = array();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $studentParams
     * @return bool
     */
    public function passes($attribute, $studentParams)
    {
        foreach ($studentParams as $key => $studentParam) {
            $studentParamName = Arr::get($studentParam, 'name');
            if (is_null($studentParamName)) {
                $this->errors[$key]['name'] = trans('validation.user.params.name.required');
            }

            $studentParamValue = Arr::get($studentParam, 'value');
            if (is_null($studentParamValue)) {
                $this->errors[$key]['value'] = trans('validation.user.params.value.required');
            }

            if (!in_array($studentParamName, StudentParamNameEnum::lists())) {
                $this->errors[$key]['name'] = trans('validation.user.params.name.in');
            } else {
                if (!in_array($studentParamName, array_keys(StudentParamTypeEnum::lists()))) {
                    $this->errors[$key]['type'] = trans('validation.user.params.type.in');
                } else {
                    $studentParamType = StudentParamTypeEnum::lists()[$studentParamName];
                    if (gettype($studentParamValue) != $studentParamType) {
                        $this->errors[$key]['value'] = trans('validation.user.params.value.' . $studentParamType);
                    }

                }
            }
        }
        return $this->errors ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errors;
    }
}

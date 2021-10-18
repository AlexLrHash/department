<?php

namespace App\Http\Requests\Api\User\Student;

use App\Rules\Api\User\Student\UpdateStudentParamRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentParamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'params' => ['required', new UpdateStudentParamRule()]
        ];
    }

    public function messages()
    {
        return [
            'params.required' => trans('validation.user.params.required')
        ];
    }
}

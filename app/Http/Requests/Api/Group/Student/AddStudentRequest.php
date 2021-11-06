<?php

namespace App\Http\Requests\Api\Group\Student;

use App\Rules\Api\Group\Student\AddStudentRule;
use Illuminate\Foundation\Http\FormRequest;

class AddStudentRequest extends FormRequest
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
            'number' => ['required', new AddStudentRule()]
        ];
    }

    /**
     * @return array
     *
     */
    public function messages()
    {
        return [
            'number.required' => trans('validation.groups.students.number.required')
        ];
    }
}

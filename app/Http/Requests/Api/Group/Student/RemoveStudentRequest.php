<?php

namespace App\Http\Requests\Api\Group\Student;

use App\Rules\Api\Group\Student\RemoveStudentRule;
use Illuminate\Foundation\Http\FormRequest;

class RemoveStudentRequest extends FormRequest
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
            'student_id' => ['required']
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'student_id.required' => trans('validation.groups.students.student_id.required')
        ];
    }
}

<?php

namespace App\Http\Requests\Api\Admin\Discipline;

use Illuminate\Foundation\Http\FormRequest;

class CreateDisciplineRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'department_id' => ['required', 'exists:departments,second_id'],
            'description' => ['sometimes', 'required', 'string'],
            'background' => ['sometimes', 'required']
        ];
    }

    /**
     * @return array|void
     */
    public function messages()
    {
        return [
            'name.required'          => trans('validation.disciplines.name.required'),
            'name.string'            => trans('validation.disciplines.name.string'),
            'department_id.required' => trans('validation.disciplines.department_id.required'),
            'department_id.exists'   => trans('validation.disciplines.department_id.exists'),
            'description.required'   => trans('validation.disciplines.description.required'),
            'description.string'     => trans('validation.disciplines.description.string')
        ];
    }
}

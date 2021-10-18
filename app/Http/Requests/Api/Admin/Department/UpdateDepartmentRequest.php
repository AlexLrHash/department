<?php

namespace App\Http\Requests\Api\Admin\Department;

use App\Rules\Api\Admin\Department\CreateDepartmentRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
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
            'name'        => ['required'],
            'description' => ['required'],
            'manager_id'  => ['required', new CreateDepartmentRule()]
        ];
    }

    /**
     * Сообщения об ошибке
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'        => trans('validation.departments.name.required'),
            'description.required' => trans('validation.departments.description.required'),
            'manager_id.required'  => trans('validation.departments.manager_id.required')
        ];
    }
}

<?php

namespace App\Http\Requests\Api\Group\Task;

use Illuminate\Foundation\Http\FormRequest;

class GroupTaskRequest extends FormRequest
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
            'description' => ['required'],
            'expired_at' => ['required', 'date']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.groups.tasks.name.required'),
            'name.string' => trans('validation.groups.tasks.name.string'),
            'description.required' => trans('validation.groups.tasks.description.required'),
            'expired_at.data' => trans('validation.groups.tasks.expired_at.data'),
            'expired_at.required' => trans('validation.groups.tasks.expired_at.required')
        ];
    }
}

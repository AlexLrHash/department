<?php

namespace App\Http\Requests\Api\Group;

use Illuminate\Foundation\Http\FormRequest;

class CreateGroupRequest extends FormRequest
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
            'discipline_id' => ['required', 'exists:disciplines,second_id']
        ];
    }

    /**
     * Сообщения
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => trans('validation.groups.name.required'),
            'name.string'   => trans('validation.groups.name.string'),
            'description.required'   => trans('validation.groups.description.required'),
            'discipline_id.required' => trans('validation.groups.discipline_id.required'),
            'discipline_id.in'       => trans('validation.groups.discipline_id.in')
        ];
    }
}

<?php

namespace App\Http\Requests\Api\Admin\User;

use App\Classes\Enum\Api\User\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name'  => ['required', 'string', 'min:6', 'max:255'],
            'email' => ['sometimes', 'email'],
            'role'  => ['required', Rule::in(array_values(UserRoleEnum::lists()))],
            'phone' => ['required', 'regex:/(?:\+375|80)\s?\(?\d\d\)?\s?\d\d(?:\d[\-\s]\d\d[\-\s]\d\d|[\-\s]\d\d[\-\s]\d\d\d|\d{5})/']
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
            'name.string'    => trans('validation.user.name.string'),
            'name.min'       => trans('validation.user.name.min'),
            'name.max'       => trans('validation.user.name.max'),
            'name.required'  => trans('validation.user.name.required'),
            'email.email'    => trans('validation.user.email.email'),
            'email.unique'   => trans('validation.user.email.unique'),
            'role.required'  => trans('validation.user.role.required'),
            'role.in'        => trans('validation.user.role.in'),
            'phone.required' => trans('validation.user.phone.required'),
            'phone.regex'    => trans('validation.user.phone.regex')
        ];
    }
}

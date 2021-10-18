<?php

namespace App\Http\Requests\Api\Auth;

use App\Classes\Enum\Api\User\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'min:6'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'confirmed'],
            'is_consent_privacy_policy' => ['sometimes', 'required', 'boolean'],
            'is_consent_terms_of_use' => ['sometimes', 'required', 'boolean'],
            'role' => ['required', Rule::in(array_values(UserRoleEnum::lists()))]
        ];
    }

    /**
     * Generate message
     *
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.required'      => trans('validation.user.name.required'),
            'name.max'           => trans('validation.user.name.max'),
            'name.min'           => trans('validation.user.name.min'),
            'email.required'     => trans('validation.user.email.required'),
            'email.email'        => trans('validation.user.email.email'),
            'email.unique'       => trans('validation.user.email.unique'),
            'password.required'  => trans('validation.user.password.required'),
            'password.confirmed' => trans('validation.user.password.confirmed'),
            'role.required'      => trans('validation.user.role.required'),
            'role.in'            => trans('validation.user.role.in')
        ];
    }
}

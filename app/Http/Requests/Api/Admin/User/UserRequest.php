<?php

namespace App\Http\Requests\Api\Admin\User;

use App\Classes\Enum\Api\User\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'role' => ['sometimes', 'string', Rule::in(array_values(UserRoleEnum::lists()))]
        ];
    }

    /**
     * Messages
     *
     * @return array|void
     */
    public function messages()
    {
        return [
            'email.required' => trans('validation.user.email.required'),
            'name.required'  => trans('validation.user.name.required'),
            'role.in'        => trans('validation.user.role.in')
        ];
    }
}

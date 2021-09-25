<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailRequest extends FormRequest
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
            'verify_token' => ['required']
        ];
    }

    /**
     * Messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'verify_token.required' => trans('validation.user.email.invalid_code')
        ];
    }
}

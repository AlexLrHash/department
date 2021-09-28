<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDisciplineRequest extends FormRequest
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
            'number_of_practices' => ['required'],
            'number_of_labs' => ['required']
        ];
    }

    /**
     * Generate custom messages
     *
     * @return array|void
     */
    public function messages()
    {
        return [
            'number_of_practices.required' => trans('validation.disciplines.number_of_practices.required'),
            'number_of_labs.required' => trans('validation.disciplines.number_of_labs.required')
        ];
    }
}

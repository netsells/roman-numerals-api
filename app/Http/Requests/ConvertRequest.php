<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvertRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'number' => 'required|numeric|min:1|max:3999',
        ];
    }

    /**
     * Set custom validation message for every rule.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'number.required' => 'Number is required',
            'number.numeric' => 'Number must be integer.'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'country_code' => 'required|string|max:10',
            'number' => [
                'required',
                'string',
                'size:9',
                'regex:/^[0-9]+$/',
                Rule::unique('contacts')->where(function ($query) {
                    return $query->where('country_code', $this->country_code);
                })->ignore($this->contact->id)
            ],
        ];
    }

    public function messages()
    {
        return [
            'country_code.required' => 'O código do país é obrigatório.',
            'number.required' => 'O número é obrigatório.',
            'number.size' => 'O número deve ter exatamente 9 dígitos.',
            'number.regex' => 'O número deve conter apenas dígitos.',
            'number.unique' => 'Este contacto já existe no sistema.',
        ];
    }
}

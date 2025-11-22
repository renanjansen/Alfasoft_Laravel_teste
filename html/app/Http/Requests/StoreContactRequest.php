<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'person_id' => 'required|exists:people,id',
            'country_code' => 'required|string|max:10',
            'number' => 'required|string|size:9|regex:/^[0-9]+$/',
        ];
    }

    public function messages()
    {
        return [
            'person_id.required' => 'A pessoa é obrigatória.',
            'person_id.exists' => 'A pessoa selecionada não existe.',
            'country_code.required' => 'O código do país é obrigatório.',
            'number.required' => 'O número é obrigatório.',
            'number.size' => 'O número deve ter exatamente 9 dígitos.',
            'number.regex' => 'O número deve conter apenas dígitos.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (\App\Models\Contact::where('country_code', $this->country_code)
                ->where('number', $this->number)
                ->exists()) {
                $validator->errors()->add('number', 'Este contato já existe no sistema.');
            }
        });
    }
}

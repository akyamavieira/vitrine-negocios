<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnboardFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'company_name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18',
            'size' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'about' => 'required|string|max:1000',
            'cep' => 'required|string|max:9',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'complement' => 'nullable|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'social_media' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser uma string.',
            'max' => [
                'string' => 'O campo :attribute não pode ter mais de :max caracteres.',
            ],
            'url' => 'O campo :attribute deve ser uma URL válida.',
        ];
    }

    public function attributes()
    {
        return [
            'company_name' => 'Nome da Empresa',
            'cnpj' => 'CNPJ',
            'size' => 'Porte da Empresa',
            'industry' => 'Área de Atuação',
            'about' => 'Sobre a Empresa',
            'cep' => 'CEP',
            'street' => 'Rua',
            'number' => 'Número',
            'complement' => 'Complemento',
            'neighborhood' => 'Bairro',
            'city' => 'Cidade',
            'social_media' => 'Redes Sociais',
            'website' => 'Website',
        ];
    }
}
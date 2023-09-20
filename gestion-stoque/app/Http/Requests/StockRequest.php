<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'categorie' => 'required|min:3',
            'article' => 'required|min:3',
            'description'=>'required|min:15',
            'prix' => 'required',
            'quantite' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'categorie.required' => 'La categorie est requise',
            'categorie.min' => 'Il faut au moins trois caracteres',
            'article.required' => 'L\'article est requise',
            'article.min' => 'Il faut au moins trois caracteres',
            'description.min' => 'Il faut au moins 15 caracteres',
            'description.required' => 'La description est requise',
            'prix.required'=>'Le prix est obligatoire',
            'quantite.required'=>'La quantite est requise'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
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
            'name' => 'required|min: 7',
            'email'=>'required|email|unique:users',
            'password' => 'required|min: 6',
            'confpassword' => 'required|min: 6'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le champ du nom doit ètre remplie',
            'name.min' => 'Le nom doit comporter au moins sept caracteres',
            'email.required' => 'Le champ de l\'email doit ètre remplie',
            'email.unique' => 'Ce email est déjàlié à un compte',
            'email.email' => 'Votre saisie ne correspond pas un email',
            'password.required' => 'Le champ du mot de passe doit ètre remplie',
            'password.min' => 'Le mot de passe doit comporter au moins six caracteres',
            'confpassword.required' => 'Le champ du mot de passe doit ètre remplie',
            'confpassword.min' => 'Le mot de passe doit comporter au moins six caracteres'
        ];
    }
}

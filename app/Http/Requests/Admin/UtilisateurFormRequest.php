<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UtilisateurFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:4'],
            'email' => ['required','email', 'unique:users'],
            'password' => 'required|min:6',
            'tel' => ['required', 'min:9'],
            'prenom' => ['required', 'min:3'],
            'adresse' => ['required', 'min:1'],
            'wilaya' => ['required', 'min:3'],
            'role' => ['required', 'min:3'],
            'image_user' => ['nullable','image','max:5000','mimes:jpeg,png,jpg,gif'],
        ];
    }
}

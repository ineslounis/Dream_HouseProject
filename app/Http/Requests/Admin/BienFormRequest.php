<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BienFormRequest extends FormRequest
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
        $rules = [
            'titre' => ['required', 'min:1'],
            'type' => ['required', 'min:3'],
            'surface' => ['required', 'integer', 'min:10'],
            'numero_etage' => ['nullable', 'integer', 'min:0'],
            'nombre_etages' => ['nullable', 'integer', 'min:0'],
            'nombre_chambre' => ['nullable', 'integer', 'min:1'],
            'prix' => ['required', 'integer', 'min:0'],
            'wilaya' => ['required', 'min:3'],
            'adresse' => ['required', 'min:3'],
            'transaction' => ['required', 'min:4'],
            'id_proprietaire' => ['required', 'min:0'],
            'agent_immobilier' => ['required'],
            'description' => ['required', 'min:8'],
            'etat' => ['required', 'boolean'],
        ];

        // Validation conditionnelle pour les images
        if ($this->isMethod('post')) {
            $rules['image'] = ['required', 'image', 'max:5000', 'mimes:jpeg,png,jpg,gif'];
        } elseif ($this->isMethod('put')) {
            $rules['image'] = ['nullable', 'image', 'max:5000', 'mimes:jpeg,png,jpg,gif'];
        }

        $rules['imgs.*'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5000'];

        return $rules;
    }
}
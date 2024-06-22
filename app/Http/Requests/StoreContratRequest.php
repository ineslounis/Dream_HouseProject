<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContratRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nom_client' => 'required|string|max:255',
            'prenom_client' => 'required|string|max:255',
            'adresse_client' => 'required|string|max:255',
            'email_client' => 'required|email|max:255',
            'nom_proprietaire' => 'required|string|max:255',
            'prenom_proprietaire' => 'required|string|max:255',
            'adresse_proprietaire' => 'required|string|max:255',
            'email_proprietaire' => 'required|email|max:255',
            'titre' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'adresse_bien' => 'required|string|max:255',
            'description' => 'required|string',
            'duree_location' => 'nullable|integer|min:1',
            'prix_initial' => 'required|min:0',
            'prix_final' => 'required|numeric|min:0',
        ];
    }
}

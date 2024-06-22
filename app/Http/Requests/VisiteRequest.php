<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisiteRequest extends FormRequest
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
            'id_client' => 'required',
            'nom_prenom' => 'required',
            'id_annonce' => 'required',
            'titre' => 'required',
            'agent_immobilier'=> 'required', 
            'id_proprietaire'=> 'required',
            'date_visite' => 'required|date',
            'heure_visite' => 'required',
        ];
    }
}

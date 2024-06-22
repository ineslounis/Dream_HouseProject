<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



class ContactController extends Controller
{
    public function envoyer(Request $request){
        // Validation des données
        $request->validate([
            'nom' => 'required',
            'objet' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'numero' => 'required',
            'date' => 'required',
            'detail' => 'required',
        ]);

        // Vérification de la connexion Internet
        if($this->isOnligne()){
            $mail_data = [
                'recipient' => 'ines.lounis@se.univ-bejaia.dz',
                'fromEmail' => $request->email,
                'fromName' => $request->nom,
                'subject' => $request->objet,
                'body' => $request->message,
                'numero' => $request->numero,
                'date' => $request->date,
                'detail' => $request->detail,
            ];

            try {
                // Envoi de l'email
                Mail::send('email-template', $mail_data, function($message) use ($mail_data) {
                    $message->to($mail_data['recipient'])
                            ->from($mail_data['fromEmail'], $mail_data['fromName'])
                            ->subject($mail_data['subject']);
                });

                return back()->with('success', 'Email envoyé avec succès!');
            } catch (\Exception $e) {
                return back()->with('error', 'Erreur lors de l\'envoi de l\'email: ' . $e->getMessage());
            }
        } else {
            return back()->with('error', 'Pas de connexion Internet.');
        }
    }

    // Fonction pour vérifier la connexion Internet
    public function isOnligne($site="https://youtube.com"){
        if(@fopen($site, "r")){
            return true;
        } else {
            return false;
        }
    }

}

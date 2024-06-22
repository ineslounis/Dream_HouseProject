<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchBiensRequest;
use App\Models\Bien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class BienController extends Controller
{
    public function index()
    {
        $utilisateur= User::orderBy('created_at','desc')->limit(6)->get();
        return view('dashboard', ['utilisateur' => $utilisateur]);
    }
    public function recherche (SearchBiensRequest $request){
        $query = Bien::query();
        if($request->input('type')) {
            $query = $query->where('type', 'like', "%{$request->validated('type')}%");
        }
        if($request->input('transaction')) {
            $query = $query->where('transaction', 'like', "%{$request->validated('transaction')}%");
        }
        if($request->input('surface')) {
            $query = $query->where('surface', '>=', $request->validated('surface'));
        }
        if($request->input('prix')) {
            $query = $query->where('prix', '<=', $request->input('prix'));
        }
        // $bien = Bien:: query()->paginate(16);
        return view('biens.annonce', [
            'biens' => $query->paginate(16),
            'input' => $request->validated()
        ]);
    }
    public function show(string $slug, Bien $bien ){
        $expectedSlug = $bien->getSlug();
        if($slug !== $expectedSlug) {
            return to_route('biens.show', ['slug' => $expectedSlug, 'bien' => $bien]);
        }
        return view('biens.show', [
           'bien' => $bien
        ]);
    }
    // public function rdv($id)
    // {
    //     $bien = Bien::findOrFail($id); // Assurez-vous que l'ID est valide
    //     return view('biens.rdv', ['bien' => $bien]);
    // }
    
    // public function showRdvForm(Bien $bien)
    // {
    //     return view('rdv', compact('bien'));
    // }




    public function showRdv(string $slug, Bien $bien ){
        $expectedSlug = $bien->getSlug();
        if($slug !== $expectedSlug) {
            return to_route('biens.rdv', ['slug' => $expectedSlug, 'bien' => $bien]);
        }
        return view('biens.rdv', [
           'bien' => $bien
        ]);
    }
 


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
                Mail::send('mail-template', $mail_data, function($message) use ($mail_data) {
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

 
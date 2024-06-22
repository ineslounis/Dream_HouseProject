<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Bien;
use App\Http\Requests\StoreContratRequest;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Auth;

// use Barryvdh\DomPDF\Facade as PDF;

use Dompdf\Options;


// use Barryvdh\DomPDF\Facade as PDF;

class ContratController extends Controller
{
    public function create(Bien $bien)
    {
        return view('biens.contrat', compact('bien'));
    }

    public function store(StoreContratRequest $request)
    {
        Contrat::create([
            'nom_client' => Auth::user()->name,
            'prenom_client' => Auth::user()->prenom,
            'adresse_client' => Auth::user()->adresse,
            'email_client' => Auth::user()->email,
            'nom_proprietaire' => $request->nom_proprietaire,
            'prenom_proprietaire' => $request->prenom_proprietaire,
            'adresse_proprietaire' => $request->adresse_proprietaire,
            'email_proprietaire' => $request->email_proprietaire,
            'titre' => $request->titre,
            'type' => $request->type,
            'adresse_bien' => $request->adresse_bien,
            'description' => $request->description,
            'duree_location' => $request->duree_location,
            'prix_initial' => $request->prix_initial,
            'prix_final' => $request->prix_final,
        ]);

      // Mettre à jour la disponibilité du bien
      $bien = Bien::find($request->bien_id);
      if ($bien) {
          $bien->etat = false; // Le bien n'est plus disponible
          $bien->save();
      }

      return redirect()->route('contrat.create', ['bien' => $request->bien_id])->with('success', 'Le contrat a été enregistré avec succès et le bien n\'est plus disponible.');
  }
       // Générer le PDF
    //    public function show($id)
    //    {
    //        $contrat = Contrat::findOrFail($id);
           
    //        // Configurer les options de DomPDF
    //        $options = new Options();
    //        $options->set('defaultFont', 'Arial');
           
    //        // Créer une nouvelle instance de PDF avec les options
    //        $pdf = PDF::setOptions($options);
           
    //        // Charger la vue dans le PDF
    //        $pdf->loadView('contrat_pdf', compact('contrat'));
           
    //        // Retourner le PDF en streaming
    //        return $pdf->stream('contrat.pdf');
    //    }
    public function index()
    {
        $contrats = Contrat::all();
        return view('indexcontrat', compact('contrats'));
    }


          }
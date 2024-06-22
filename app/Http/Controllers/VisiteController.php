<?php

namespace App\Http\Controllers;

use App\Models\Visite;
use App\Http\Requests\VisiteRequest;
use App\Models\Bien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\VisiteScheduled;
use Illuminate\Support\Facades\Mail;
use App\Models\User;


class VisiteController extends Controller
{
    /**
     * Affiche le formulaire pour prendre un rendez-vous de visite.
     *
     * @param  \App\Models\Bien  $bien
     * @return \Illuminate\Http\Response
     */
  public function showForm(Bien $bien)
{
    // Passer les dates possibles à la vue
    $datesPossibles = $this->getDatesPossibles($bien->id);
    
    // Passer les dates prises à la vue
    $datesPrises = Visite::where('id_annonce', $bien->id)
                         ->pluck('date_visite')
                         ->toArray();

    // Générer la liste des horaires disponibles de 8h à 19h
    $horairesDisponibles = [];
    for ($heure = 8; $heure <= 19; $heure++) {
        $horairesDisponibles[] = sprintf('%02d:00', $heure); // Formatage de l'heure avec deux chiffres
    }

    // Retourner la vue avec toutes les données nécessaires
    return view('biens.rdv', compact('bien', 'datesPrises', 'datesPossibles', 'horairesDisponibles'));
}

    
    
    /**
     * Stocke une nouvelle visite dans la base de données.
     *
     * @param  \App\Http\Requests\VisiteRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VisiteRequest $request)
    {
        try {
            $validatedData = $request->validated();
    
            // Vérifier si une visite existe déjà pour cette date et cette heure
            $visiteExistante = Visite::where('id_annonce', $validatedData['id_annonce'])
                                      ->where('date_visite', $validatedData['date_visite'])
                                      ->where('heure_visite', $validatedData['heure_visite'])
                                      ->exists();
    
            if ($visiteExistante) {
                return back()->withErrors('Désolé, cette date et heure sont déjà prises pour ce bien immobilier.');
            }
    
            // Enregistrer la visite dans la base de données
            $visite = new Visite();
            $visite->id_client = Auth::id();
            $visite->nom_prenom = $validatedData['nom_prenom'];
            $visite->id_annonce = $validatedData['id_annonce'];
            $visite->titre = $validatedData['titre'];
            $visite->agent_immobilier = $validatedData['agent_immobilier'];
            $visite->id_proprietaire = $validatedData['id_proprietaire'];
            $visite->date_visite = $validatedData['date_visite'];
            $visite->heure_visite = $validatedData['heure_visite'];
            $visite->save();
    
            // Préparer les détails pour l'email
            $details = [
                'nom_prenom' => $validatedData['nom_prenom'],
                'titre' => $validatedData['titre'],
                'agent_immobilier' => $validatedData['agent_immobilier'],
                'date_visite' => $validatedData['date_visite'],
                'heure_visite' => $validatedData['heure_visite']
            ];
    
           
    
            // Envoyer l'email à l'administrateur
            Mail::to('ines.lounis@se.univ-bejaia.dz')->send(new VisiteScheduled($details));
            // Envoyer l'email à l'agent immobilier
           // Récupérer l'email de l'agent immobilier à partir de la base de données
        $agentEmail = User::where('id', $validatedData['agent_immobilier'])->value('email');

        if ($agentEmail) {
            // Envoyer l'email à l'agent immobilier
            Mail::to($agentEmail)->send(new VisiteScheduled($details));
        } else {
            Log::error('Email de l\'agent immobilier non trouvé pour l\'ID: ' . $validatedData['agent_immobilier']);
        }
    
            return redirect()->route('rdv.showForm', ['bien' => $visite->id_annonce])->with('success', 'La visite a été enregistrée avec succès et les emails ont été envoyés.');
        } catch (\Exception $e) {
            return back()->withErrors('Une erreur est survenue lors de l\'enregistrement de la visite.');
        }
    }
    /**
     * Récupère toutes les dates possibles pour une visite.
     *
     * @return array
     */
 
   

     public function getHeuresDisponibles(Request $request)
     {
         try {
             $date_visite = $request->query('date_visite');
             $id_annonce = $request->query('id_annonce');
     
             Log::info('Request parameters', ['date_visite' => $date_visite, 'id_annonce' => $id_annonce]);
     
             // Récupérer les heures de visites pour le bien immobilier à la date donnée
             $visitesPourLeBien = Visite::where('id_annonce', $id_annonce)
                 ->where('date_visite', $date_visite)
                 ->pluck('heure_visite')
                 ->toArray();
     
             Log::info('Visites pour le bien', ['visitesPourLeBien' => $visitesPourLeBien]);
     
             // Récupérer l'agent immobilier pour le bien
             $agent_immobilier = Bien::where('id', $id_annonce)
                 ->pluck('agent_immobilier')
                 ->first();
     
             Log::info('agent_immobilier', ['agent_immobilier' => $agent_immobilier]);
     
             // Récupérer les heures de visites pour l'agent immobilier à la date donnée
             $visitesPourLagent = Visite::where('agent_immobilier', $agent_immobilier)
                 ->where('date_visite', $date_visite)
                 ->pluck('heure_visite')
                 ->toArray();
     
             Log::info('Visites pour l\'agent', ['visitesPourLagent' => $visitesPourLagent]);
     
             // Fusionner les heures prises pour le bien et pour l'agent
             $heuresPrises = array_merge($visitesPourLeBien, $visitesPourLagent);
     
           
         // Générer les horaires disponibles de 8h à 19h
$horairesDisponibles = [];
$horairesNonDisponibles = [];
for ($heure = 8; $heure <= 19; $heure++) {
    $heureFormat = sprintf('%02d:00', $heure);
    if (in_array($heureFormat, $heuresPrises)) {
        $horairesNonDisponibles[] = $heureFormat;
    } else {
        $horairesDisponibles[] = $heureFormat;
    }
}

Log::info('Horaires disponibles et non disponibles', [
    'available' => $horairesDisponibles,
    'unavailable' => $horairesNonDisponibles
]);

// Retourner les horaires disponibles et non disponibles en JSON
return response()->json([
    'available' => $horairesDisponibles,
    'unavailable' => $horairesNonDisponibles
]);

         } catch (\Exception $e) {
             Log::error('Error in getHeuresDisponibles', ['exception' => $e]);
             return response()->json(['error' => 'Une erreur est survenue'], 500);
         }
     }
     
     
     
     
     
     
     
  public function index()
{
    $user = Auth::user();
    Log::info('User role:', ['role' => $user->role]);
    
    $role = $user->role;

    if ($role === 'admin' || $role === 'agence') {
        Log::info('Fetching all visits for admin or agence');
        $mesVisites = Visite::all();
        $visitesDeMesBiens = Visite::all();
        $mesVisitesProprietaire = collect(); // Vide pour admin et agence
        $mesVisitesAgent = collect(); // Vide pour admin et agence
        $mesVisitesClient = collect(); // Vide pour admin et agence
    } elseif ($role === 'agent') {
        Log::info('Fetching visits for agent', ['agent_immobilier' => $user->id]);
        $mesVisites = Visite::where('agent_immobilier', $user->id)->get();
        $visitesDeMesBiens = Visite::where('agent_immobilier', $user->id)->get();
        $mesVisitesProprietaire = collect(); // Vide pour les agents
        $mesVisitesAgent = $mesVisites; // Les visites de l'agent
        $mesVisitesClient = collect(); // Vide pour les agents
    } elseif ($role === 'client') {
        Log::info('Fetching visits for client', ['id_client' => $user->id]);
        $mesVisites = Visite::where('id_client', $user->id)->get();
        $visitesDeMesBiens = Visite::whereIn('id_annonce', Bien::where('id_proprietaire', $user->id)->pluck('id'))->get();
        $mesVisitesProprietaire = $visitesDeMesBiens; // Les visites des biens où le client est propriétaire
        $mesVisitesAgent = collect(); // Vide pour les clients
        $mesVisitesClient = $mesVisites; // Les visites du client
    } else {
        Log::warning('Unknown role', ['role' => $role]);
        $mesVisites = collect();
        $visitesDeMesBiens = collect();
        $mesVisitesProprietaire = collect();
        $mesVisitesAgent = collect();
        $mesVisitesClient = collect();
    }

    Log::info('Mes Visites:', ['mesVisites' => $mesVisites->toArray()]);
    Log::info('Visites de Mes Biens:', ['visitesDeMesBiens' => $visitesDeMesBiens->toArray()]);
    Log::info('Mes Visites Propriétaire:', ['mesVisitesProprietaire' => $mesVisitesProprietaire->toArray()]);
    Log::info('Mes Visites Agent:', ['mesVisitesAgent' => $mesVisitesAgent->toArray()]);
    Log::info('Mes Visites Client:', ['mesVisitesClient' => $mesVisitesClient->toArray()]);

    return view('biens.visites', compact('mesVisites', 'visitesDeMesBiens', 'mesVisitesProprietaire', 'mesVisitesAgent', 'mesVisitesClient'));
}

     
     
     
     
     
    
     public function mesVisites()
     {
         // Récupérez toutes les visites associées à l'utilisateur en tant que client
         $mesVisites = Visite::where('id_client', auth()->id())->get();
     
         // Vérifiez que l'utilisateur a bien la relation 'biens'
         $userBiens = auth()->user()->biens;
         if ($userBiens) {
             // Récupérez toutes les visites des biens de l'utilisateur en tant que propriétaire
             $visitesDeMesBiens = Visite::whereIn('id_annonce', $userBiens->pluck('id'))->get();
         } else {
             $visitesDeMesBiens = collect(); // Retournez une collection vide si pas de biens
         }
     
         // Passez les données à la vue
         return view('visites', compact('mesVisites', 'visitesDeMesBiens'));
     }
     
    
    protected function getDatesPossibles($id_bien)
    {
        // Exemple de génération de dates pour les 30 prochains jours
        $datesPossibles = [];
        $startDate = now();
        $endDate = now()->addDays(30);
    
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            // Vous pouvez ajouter d'autres logiques pour exclure certains jours, par exemple les week-ends
            if (!$date->isWeekend()) {
                $datesPossibles[] = $date->toDateString();
            }
        }
    
        // Récupérer toutes les dates prises pour ce bien
        $datesPrises = Visite::where('id_annonce', $id_bien)
                             ->pluck('date_visite')
                             ->toArray();
    
        // Retirer les dates prises des dates possibles
        $datesPossibles = array_diff($datesPossibles, $datesPrises);
    
        return $datesPossibles;
    }
    
   
    

    
}


<?php

namespace App\Http\Controllers;

use App\Http\Requests\BienContactRequest;
use App\Http\Requests\OffreRequest;
use App\Models\Bien;
use App\Models\Utilisateur;
use App\Http\Requests\SearchBiensRequest;
use App\Http\Requests\SearchUsersRequest;
use App\Mail\BienContactMail;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;




class HomeController extends Controller
{
    public function index()
{
    $bien = Bien::orderBy('created_at', 'desc')->limit(6)->available()->get();
    $utilisateur = User::orderBy('created_at', 'desc')->limit(6)->get();
    
    return view('dashboard', [
        'bien' => $bien,
        'utilisateur' => $utilisateur,
    ]);
}
//     public function indexx()
// {
//     $bien = Bien::orderBy('created_at', 'desc')->limit(6)->available()->get();
//     $utilisateur = User::orderBy('created_at', 'desc')->limit(6)->get();
    
//     return view('index', [
//         'bien' => $bien,
//         'utilisateur' => $utilisateur,
//     ]);
// }

  
   
    // public function annonce()
// {
//     $bien = Bien::orderBy('created_at', 'desc')->limit(25)->available()->get();
//     return view('biens.annonce', ['bien' => $bien]);
// }
public function annonce()
{
    $bien= Bien::orderBy('created_at','desc')->limit(20)-> available()->get() ;
        return view('biens.annonce', ['bien' => $bien]);
}
public function agent()
{
    $utilisateur= User::orderBy('created_at','desc')->limit(20)->get() ;
        return view('agents.agent', ['utilisateur' => $utilisateur]);
}



      

   


    
    public function user()
    {
        $utilisateur= Utilisateur::orderBy('created_at','desc')->limit(6)->get();
        return view('users.index', ['utilisateur' => $utilisateur]);
    }
    public function recherche(SearchBiensRequest $request){
        $query = Bien::query()-> available();
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
    public function rechercher(SearchUsersRequest $request){
        try {
            $query = User::query();
    
            // Filtre par ID
            if($request->input('id')) {
                $query = $query->where('id', '=', $request->input('id'));
            }
    
            // Filtre par Nom
            if($request->input('nom')) {
                $query = $query->where('name', 'like', "%{$request->validated()['nom']}%");
            }
    
            // Filtre par Prénom
            if($request->input('prenom')) {
                $query = $query->where('prenom', 'like', "%{$request->validated()['prenom']}%");
            }
    
            // Filtre par Rôle
            if($request->input('role')) {
                $query = $query->where('role', 'like', "%{$request->validated()['role']}%");
            }
    
            // Affichage du SQL pour débogage
            dd($query->toSql(), $query->getBindings());
    
            // Exécution de la requête et renvoi des résultats à la vue
            return view('admin.users.index', [
                'utilisateur' => $query->paginate(16),
                'input' => $request->validated()
            ]);
        } catch (\Exception $e) {
            // Gestion des erreurs
            return redirect()->back()->withErrors(['message' => 'Une erreur s\'est produite lors de la recherche.']);
        }
    }
    
    
    public function show(string $slug, Bien $bien ){

        $expectedSlug = $bien->getSlug();
        if($slug !== $expectedSlug) {
            return to_route('biens.show', ['slug' => $expectedSlug, 'bien' => $bien]);
        }
         // Récupérez l'offre maximale pour ce bien
         $offre_max = Offre::where('annonce_id', $bien->id)->orderBy('message', 'desc')->first();
         $offre_max = Offre::where('annonce_id', $bien->id)
         ->orderBy('message', 'desc')
         ->first();
 
         $offre_max = Offre::where('annonce_id', $bien->id)
         ->orderBy('message', 'desc')
         ->first();
 
 // Vérifier si une offre maximale a été trouvée
 if ($offre_max) {
 // Une offre maximale a été trouvée, vous pouvez l'utiliser dans la vue
 return view('biens.show', [
 'bien' => $bien,
 'offre_max' => $offre_max,
 ]);
 } else {
  
    return view('biens.show', [
        'bien' => $bien,
        'offre_max' => $offre_max // Toujours passer cette variable
     ]);
 }
 
 
    }
    public function annonces()
    {
        $bien= Bien::orderBy('created_at','desc')->get();
        return view('annonce', ['bien' => $bien]);
    }
   
    // public function contact(Bien $bien, BienContactRequest $request)
    // {
    //    Mail::send(new BienContactMail($bien, $request->validated()));
    //    return back()->with('success', 'Votre demande de contact a bien été envoyée');
    // }
  // Dans la méthode contact de votre contrôleur HomeController
  public function contact(OffreRequest $request)
  {
      // Validation des données
     
      $request->validate([
           'firstname' => 'required|string|max:255',
              'lastname' => 'required|string|max:255',
              'phone' => 'required|string|max:20',
              'email' => 'required|email|max:255',
              'message' => 'required|string|max:5000',
              'annonce_id' => 'required',
              'annonce_titre' => 'required|string|max:255',
      ]);
     $validatedData = $request->validated();
              $offre = new Offre();
              $offre->firstname = $validatedData['firstname'];
              $offre->lastname = $validatedData['lastname'];
              $offre->phone = $validatedData['phone'];
              $offre->email = $validatedData['email'];
              $offre->message = $validatedData['message'];
              $offre->annonce_id = $validatedData['annonce_id'];
              $offre->annonce_titre = $validatedData['annonce_titre'];
              $offre->save();
      // Vérification de la connexion Internet
      if ($this->isOnline()) {
          $mailData = [
              'firstname' => $request->firstname,
              'lastname' => $request->lastname,
              'phone' => $request->phone,
              'email' => $request->email,
              'message' => $request->message,
              'annonce_id' => $request->annonce_id,
              'annonce_titre' => $request->annonce_titre,
          ];
         
          try {
           
              // Envoi de l'e-mail avec les données correctes
              Mail::send(new BienContactMail($mailData)); // Utilisation de new BienContactMail pour créer une instance de l'e-mail
  
              return back()->with('success', 'Votre message a été envoyé avec succès!');
          } catch (\Exception $e) {
              return back()->with('error', 'Erreur lors de l\'envoi de l\'email: ' . $e->getMessage());
          }
      } else {
          return back()->with('error', 'Pas de connexion Internet.');
      }
  }


    // Fonction pour vérifier la connexion Internet
    public function isOnline($site = "https://www.google.com/")
    {
        $connected = @fopen($site, "r");
        if ($connected) {
            fclose($connected);
            return true;
        } else {
            return false;
        }
    }

    public function index1()
    {
            return view('accueiladmin', [
                'biens' => Bien::orderBy('created_at', 'desc')-> available()->withTrashed()->paginate(25)
            ]);
            
    }
    

    public function index2()
    {
            return view('accueilagence', [
                'biens' => Bien::orderBy('created_at', 'desc')-> available()->withTrashed()->paginate(25)
            ]);
            
    }
    public function showRdvForm(Bien $bien)
    {
        return view('biens.rdv', [
            'bien' => $bien
        ]);
    }
    public function contrat(Bien $bien)
    {
        return view('biens.contrat',[
            'bien' => $bien
        ]);
    }
    public function showcontrat($id)
    {
        // Récupérer le bien avec les informations du propriétaire
        $bien = Bien::with('proprietaire')->findOrFail($id);

        return view('contrat', compact('bien'));
    }
    
    
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BienFormRequest;
use App\Models\Bien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class BienController extends Controller
{
    public function index()
    {
        $biens = Bien::orderBy('created_at', 'desc')->withTrashed()->paginate(25);
        return view('admin.bien.index', compact('biens'));
    }

    public function create()
    {
        $agents = User::where('role', 'agent')->get();
        $proprietaires = User::pluck('id');
        $bien = new Bien();
        return view('admin.bien.ajouterannonce', compact('bien', 'agents', 'proprietaires'));
    }

    public function store(BienFormRequest $request)
    {
        $validatedData = $request->validated();
        
        try {
            DB::beginTransaction();
            
            // Création du bien avec les données validées
            $bien = Bien::create($validatedData);
            
            // Enregistrement de l'image principale
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $bien->image = $imageName;
                $bien->save();
            }
            
            // Enregistrement des images multiples
            $imgs = [];
            if ($request->hasFile('imgs')) {
                foreach ($request->file('imgs') as $file) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('images'), $imageName);
                    $imgs[] = $imageName;
                }
            }
            
            // Conversion du tableau $imgs en JSON et enregistrement dans la base de données
            $bien->imgs = json_encode($imgs);
            $bien->save();
            
            DB::commit();
            
            return redirect()->route('admin.bien.index')->with('success', 'Le bien a été créé avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Une erreur est survenue lors de la création du bien : ' . $e->getMessage());
        }
    }

    public function edit(Bien $bien)
    {
        $agents = User::where('role', 'agent')->get();
        $proprietaires = User::pluck('id');
        return view('admin.bien.ajouterannonce', compact('bien', 'agents', 'proprietaires'));
    }

    public function update(Bien $bien, BienFormRequest $request)
    {
        // Démarre une transaction
        DB::beginTransaction();
    
        try {
            // Mise à jour des champs de base
            $bien->update($request->validated());
    
            // Gestion de l'image principale
            if ($request->hasFile('image')) {
                // Supprime l'ancienne image principale si elle existe
                if ($bien->image) {
                    $oldImagePath = public_path('images/' . $bien->image);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }
                // Enregistre la nouvelle image principale
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $bien->image = $imageName;
            }
    
            // Gestion des images multiples
            if ($request->hasFile('imgs')) {
                $imgs = []; // Tableau pour stocker les noms de fichiers
    
                // Supprime les anciennes images si elles existent physiquement et dans la base de données
                if ($bien->imgs) {
                    // Assurez-vous que imgs est une chaîne JSON valide
                    $oldImages = is_array($bien->imgs) ? $bien->imgs : json_decode($bien->imgs, true);
    
                    foreach ($oldImages as $oldImage) {
                        $oldImagePath = public_path('images/' . $oldImage);
                        if (File::exists($oldImagePath)) {
                            File::delete($oldImagePath);
                        }
                    }
                }
    
                // Enregistre les nouvelles images
                foreach ($request->file('imgs') as $file) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('images'), $imageName);
                    $imgs[] = $imageName;
                }
    
                // Met à jour la colonne imgs avec le tableau encodé en JSON
                $bien->imgs = json_encode($imgs);
            }
    
            $bien->save();
    
            DB::commit();
            // Ajouter un log pour vérifier
            Log::info('Le bien a été modifié avec succès.', ['bien_id' => $bien->id]);
    
            return redirect()->route('admin.bien.index')->with('success', 'Le bien a été modifié avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Une erreur est survenue lors de la modification du bien.', ['exception' => $e]);
            return redirect()->route('admin.bien.index')->with('error', 'Une erreur est survenue lors de la modification du bien : ' . $e->getMessage());
        }
    }
    
    

    public function destroy(Bien $bien)
    {
        try {
            DB::beginTransaction();
            
            // Suppression de l'image principale
            $this->deleteImage($bien->image);
            
            // Suppression des images multiples
            foreach (json_decode($bien->imgs, true) ?? [] as $image) {
                $this->deleteImage($image);
            }
            
            // Suppression du bien
            $bien->delete();
            
            DB::commit();
            
            return redirect()->route('admin.bien.index')->with('success', 'Le bien a été supprimé avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.bien.index')->with('error', 'Une erreur est survenue lors de la suppression du bien : ' . $e->getMessage());
        }
    }

    // Méthode pour supprimer une image du dossier public/images
    private function deleteImage($imageName)
    {
        if ($imageName) {
            $imagePath = public_path('images/' . $imageName);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
    }

    // Autres méthodes (rdv, showRdvForm, envoyer, isOnline) inchangées...
}


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UtilisateurFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'utilisateur' => User::orderBy('created_at', 'desc')->withTrashed()->paginate(25)
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.users.signup', [
            'utilisateur' => new User()
        ]);
    }

    public function store(UtilisateurFormRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['password'] = Hash::make($request->password);
            $utilisateur = User::create($validatedData);

            if ($request->hasFile('image_user')) {
                $imageName = time() . '.' . $request->image_user->extension();
                $request->image_user->move(public_path('images'), $imageName);
                $utilisateur->image_user = $imageName;
                $utilisateur->save();
            }

            return redirect()->route('admin.users.index')->with('success', 'Un utilisateur a été ajouté');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Une erreur est survenue lors de l\'ajout de l\'utilisateur: ' . $e->getMessage());
        }
    }

    public function edit(User $utilisateur)
    {
        return view('admin.users.signup', [
            'utilisateur' => $utilisateur,
        ]);
    }

    public function update(UtilisateurFormRequest $request, User $utilisateur)
    {
        $utilisateur->update($request->validated());
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur a été modifié');
    }

    public function destroy(User $utilisateur)
    {
        try {
            $utilisateur->delete();
            return redirect()->route('admin.users.index')->with('success', 'Utilisateur a bien été supprimé');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la suppression de l\'utilisateur: ' . $e->getMessage());
        }
    }
}

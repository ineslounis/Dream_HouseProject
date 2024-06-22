<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->user()->id],
            'adresse' => ['required', 'string', 'max:255'],
            'wilaya' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'image_user' => ['nullable', 'image', 'max:2048'],
        ]);
    
        $user = $request->user();
        $user->name = $request->name;
        $user->prenom = $request->prenom;
        $user->tel = $request->tel;
        $user->email = $request->email;
        $user->adresse = $request->adresse;
        $user->wilaya = $request->wilaya;
        $user->role = $request->role;
    
        if ($request->hasFile('image_user')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $user->image = $imageName;
            $user->save();
        }
    
        $user->save();
    
        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller{
    public function show($id){
        $user= User::findOrFail($id);
        return view('profile.show',compact('user'));
    }
    public function edit(Request $request): View{
        return view('profile.edit', [
            'user'=> $request->user(),
        ]);
    }



    public function update(Request $request){
        $request->validate([
            'name'=> 'required|string|max:255',
            'bio'=> 'nullable|string',
            'specialite'=> 'nullable|string|max:255',
            'photo'=> 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);
        $user = Auth::user();


        if ($request->hasFile('photo')){
            $path= $request->file('photo')->store('profiles', 'public');
            $user->photo =$path;
        }
        $user->name = $request->name;
        $user->bio = $request->bio;
        $user->specialite = $request->specialite;
        $user->save();
        return Redirect::route('profile.edit')->with('success', 'Profil mis à jour');
    }



    public function destroy(Request $request){
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        $user= $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/');
    }
}

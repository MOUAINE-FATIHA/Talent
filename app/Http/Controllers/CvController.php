<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    public function index()
    {
        $cv = Auth::user()->cv;
        return view('cv.show', compact('cv'));
    }

    public function create(){
        // si user a uncv
        if (Auth::user()->cv) {
            return redirect()->route('cv.show')->with('info', 'Vous avez déjà un CV.');
        }
        
        return view('cv.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $cv = Cv::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
        ]);

        return redirect()->route('cv.show')->with('success', 'CV créé avec succès!');
    }
}
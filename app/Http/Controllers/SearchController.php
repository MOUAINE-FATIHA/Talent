<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->q;
        $users = User::where('name','like',"%$q%")
                    ->orWhere('specialite','like',"%$q%")
                    ->get();
        return view('search.results', compact('users','q'));
    }
}

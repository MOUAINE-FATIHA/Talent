<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller{
    public function index(Request $request){
        $query = User::query();
        if ($request->filled('name')){
            $query->where('name','like','%' . $request->name . '%');
        }
        if ($request->filled('specialite')){
            $query->where('specialite','like', '%' .  $request->specialite . '%');
        }
        $users = $query->whereNotNull('specialite')->get();
        return view('search.results',compact('users'));
    }
}

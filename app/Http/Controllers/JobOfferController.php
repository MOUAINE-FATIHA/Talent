<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    public function index(Request $request){
        $jobOffers =JobOffer::latest()->paginate(6);
        return view('job_offers.index', comppact('jobOffers'));
        
    }
}

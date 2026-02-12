<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use App\Models\Application;
use App\Models\Recruteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobOfferController extends Controller
{
    private function getRecruteur(){
        $recruteur = Recruteur::where('user_id', Auth::id())->first();
        if (!$recruteur) {
            $recruteur = Recruteur::create(['user_id' => Auth::id()]);
        }
        return $recruteur;
    }

    private function authorizeRecruteur(JobOffer $jobOffer): void{
        $recruteur = $this->getRecruteur();
        if ($jobOffer->recruteur_id !== $recruteur->id) {
            abort(403, 'Vous ne pouvez pas modifier cette offre');
        }
    }

    public function index(Request $request){
        $jobOffers = JobOffer::where('closed', false)->latest()->paginate(6);
        return view('listeOffres', compact('jobOffers'));
    }

    public function show(JobOffer $jobOffer){
        return view('job_offers.show', compact('jobOffer'));
    }

    public function apply(JobOffer $jobOffer){
        $existingApplication = Application::where('user_id', Auth::id())
            ->where('job_offer_id',$jobOffer->id)
            ->first();
        if ($existingApplication){
            return back()->with('error', 'Vous avez déjà postulé');
        }
        Application::create([
            'user_id'=> Auth::id(),
            'job_offer_id'=>$jobOffer->id,
            'status'=>'pending',
        ]);
        return back()->with('success','votre candidature a été envoyée');
    }

    public function create(){
        return view('job_offers.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'titre'=> 'required|string|max:255',
            'description' =>'required|string',
            'type_contrat'=> 'required|string',
            'entreprise'=>'required|string|max:255',
        ]);

        $recruteur =$this->getRecruteur();
        $validated['recruteur_id'] =   $recruteur->id;
        $validated['image'] =  null;

        JobOffer::create($validated);
        return redirect()->route('job.my_offers')->with('success', 'la création est réussite');
    }

    public function edit(JobOffer $jobOffer){
        $this->authorizeRecruteur($jobOffer);
        return view('job_offers.edit',compact('jobOffer'));
    }

    public function update(Request $request, JobOffer $jobOffer){
        $this->authorizeRecruteur($jobOffer);
        $validated = $request->validate([
            'titre'=> 'required|string|max:255',
            'description'=> 'required|string',
            'type_contrat'=>'required|string',
            'entreprise'=> 'required|string|max:255',
            'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')){
            if ($jobOffer->image){
                Storage::disk('public')->delete($jobOffer->image);
            }
            $validated['image']= $request->file('image')->store('job_offers', 'public');
        } else{
            $validated['image']= $jobOffer->image;
        }

        $jobOffer->update($validated);
        return redirect()->route('job.my_offers')->with('success', 'Offre mise à jour.');
    }

    public function destroy(JobOffer $jobOffer){
        $this->authorizeRecruteur($jobOffer);
        if ($jobOffer->image){
            Storage::disk('public')->delete($jobOffer->image);
        }
        $jobOffer->delete();
        return redirect()->route('job.my_offers')->with('success', 'Offre supprimée.');
    }

    public function myOffers(){
        $recruteur = $this->getRecruteur();
        $jobOffers = JobOffer::where('recruteur_id', $recruteur->id)
            ->with(['applications.user'])
            ->latest()
            ->get();
        return view('job_offers.my_offers', compact('jobOffers'));
    }

    public function toggleClose(JobOffer $jobOffer){
        $this->authorizeRecruteur($jobOffer);
        $jobOffer->update(['closed'=>!$jobOffer->closed]);
        $message = $jobOffer->closed
            ? 'il est clôturée'
            : 'il est réouverte';
        return back()->with('success',$message);
    }
}

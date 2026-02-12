<?php
namespace App\Http\Controllers;
use App\Models\JobOffer;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobOfferController extends Controller{
    public function index(Request $request){
        $jobOffers = JobOffer::where('closed', false)->latest()->paginate(6);
        return view('listeOffres', compact('jobOffers'));
    }

    public function show(JobOffer $jobOffer)
    {
        return view('job_offers.show', compact('jobOffer'));
    }

    public function apply(JobOffer $jobOffer)
    {
        
        $existingApplication = Application::where('user_id', Auth::id())
            ->where('job_offer_id', $jobOffer->id)
            ->first();

        if ($existingApplication) {
            return back()->with('error', 'Vous avez déjà postulé à cette offre.');
        }

        Application::create([
            'user_id' => Auth::id(),
            'job_offer_id' => $jobOffer->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Votre candidature a été envoyée avec succès!');
    }
    public function create()
    {
        return view('job_offers.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'type_contrat' => 'required|string',
            'entreprise' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('job_offers', 'public');
            $validated['image'] = $imagePath;
        }
        $recruteur = \App\Models\Recruteur::where('user_id', Auth::id())->first();
        
        if (!$recruteur) {
            $recruteur = \App\Models\Recruteur::create(['user_id' => Auth::id()]);
        }

        $validated['recruteur_id'] = $recruteur->id;

        JobOffer::create($validated);

        return redirect()->route('job.offers')->with('success', 'Offre d\'emploi créée avec succès!');
    }

    /**
     * Display recruiter's job offers with applications
     */
    public function myOffers()
    {
        //les recuteurs
        $recruteur = \App\Models\Recruteur::where('user_id', Auth::id())->first();
        
        if (!$recruteur) {
            $recruteur = \App\Models\Recruteur::create(['user_id' => Auth::id()]);
        }
        $jobOffers = JobOffer::where('recruteur_id', $recruteur->id)
            ->with(['applications.user'])
            ->latest()
            ->get();

        return view('job_offers.my_offers', compact('jobOffers'));
    }
    public function toggleClose(JobOffer $jobOffer)
    {
        
        $recruteur = \App\Models\Recruteur::where('user_id', Auth::id())->first();
        
        if (!$recruteur || $jobOffer->recruteur_id !== $recruteur->id) {
            abort(403, 'Vous ne pouvez pas modifier cette offre');
        }

        $jobOffer->update(['closed' => !$jobOffer->closed]);

        $message = $jobOffer->closed 
            ? 'L\'offre a été clôturée' 
            : 'L\'offre a été réouverte';

        return back()->with('success', $message);
    }
}
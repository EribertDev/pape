<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\StageContractMail;
use Illuminate\Support\Facades\Storage;
use App\Mail\NewDemandeStageMail;
use App\Mail\ContratSigned;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $departements = [
                'Alibori' => [
                    'Banikoara', 'Gogounou', 'Kandi', 'Karimama', 'Malanville', 'Ségbana'
                ],
                'Atacora' => [
                    'Boukoumbé', 'Cobly', 'Kérou', 'Kouandé', 'Matéri', 'Natitingou', 'Péhunco', 'Tanguiéta', 'Toucountouna'
                ],
                'Atlantique' => [
                    'Abomey-Calavi', 'Allada', 'Kpomassè', 'Ouidah', 'Sô-Ava', 'Toffo', 'Tori-Bossito', 'Zè'
                ],
                'Borgou' => [
                    'Bembèrèkè', 'Kalalé', 'N\'Dali', 'Nikki', 'Parakou', 'Pèrèrè', 'Sinendé', 'Tchaourou'
                ],
                'Collines' => [
                    'Bantè', 'Dassa-Zoumè', 'Glazoué', 'Ouèssè', 'Savalou', 'Savè'
                ],
                'Couffo' => [
                    'Aplahoué', 'Djakotomey', 'Dogbo', 'Klouékanmè', 'Lalo', 'Toviklin'
                ],
                'Donga' => [
                    'Bassila', 'Copargo', 'Djougou', 'Ouaké'
                ],
                'Littoral' => [
                    'Cotonou'
                ],
                'Mono' => [
                    'Athiémé', 'Bopa', 'Comè', 'Grand-Popo', 'Houéyogbé', 'Lokossa'
                ],
                'Ouémé' => [
                    'Adjarra', 'Adjohoun', 'Aguégués', 'Akpro-Missérété', 'Avrankou', 'Bonou', 'Dangbo', 'Porto-Novo', 'Sèmè-Podji'
                ],
                'Plateau' => [
                    'Adja-Ouèrè', 'Ifangni', 'Kétou', 'Pobè', 'Sakété'
                ],
                'Zou' => [
                    'Abomey', 'Agbangnizoun', 'Bohicon', 'Covè', 'Djidja', 'Ouinhi', 'Zagnanado', 'Za-Kpota', 'Zogbodomey'
                ],
  ] ;

  return view('clients.layouts.services.stage')->with('departements',$departements);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $validated = $request->validate([
        'specialite' => 'nullable|string|max:255',
        'university' => 'required|string|max:255',
        'domaine' => 'required|string|max:255',
        'level' => 'required|string|max:50',
        'duration' => 'required|integer|min:1',
        'commune' => 'required|string|max:255',
        'structure' => 'required|string|max:255',
        'recommendation_letter' => 'required|file|mimes:pdf|max:2048',
        'binome' => 'nullable|string|max:255'
    ]);

    try {
        // Stockage de la lettre de recommandation
        $letterPath = $request->file('recommendation_letter')->store('recommendation_letters');

        // Création de la demande
        $internshipRequest = Stage::create([
            'user_id' => auth()->id(),
            'university' => $validated['university'],
            'domaine' => $validated['domaine'],
            'level' => $validated['level'],
            'specialite'=>$validated['specialite'] ?? null, // Spécialité optionnelle
            'duration' => $validated['duration'],
            'commune' => $validated['commune'],
            'structure' => $validated['structure'],
            'recommendation_letter_path' => $letterPath,
            'binome' => $validated['binome'] ?? null,
            'status' => 'pending',
            'message' => $request->input('message', '') // Message optionnel
        ]);

        // Génération du PDF
        $pdfData = [
            'student' => $clientName = session('clientInfo')->fist_name . ' ' . session('clientInfo')->last_name,
            'binome' => $internshipRequest->binome,
            'university' => $internshipRequest->university,
            'stucture' => $internshipRequest->structure,
            'domaine' => $internshipRequest->domaine,
            'level' => $internshipRequest->level,
            'duration' => $internshipRequest->duration,
            'date' => now()->format('d/m/Y')
        ];

        $pdf = Pdf::loadView('emails.internship_contract', $pdfData);
        $pdfPath = 'contracts/contract_'.$internshipRequest->id.'.pdf';
        Storage::put($pdfPath, $pdf->output());

        // Mise à jour avec le chemin du contrat
        $internshipRequest->update(['contract_path' => $pdfPath]);

        // Envoi du mail avec le contrat
        Mail::to(auth()->user()->email)
            ->send(new StageContractMail($internshipRequest,$clientName = session('clientInfo')->fist_name . ' ' . session('clientInfo')->last_name));

        $clientName = session('clientInfo')->fist_name . ' ' . session('clientInfo')->last_name;

        // Envoi du mail au service client
         Mail::to('serviceclient@cesiebenin.com')
        ->send(new NewDemandeStageMail($internshipRequest,$clientName));
        // Réponse AJAX
        return response()->json([
            'success' => true,
            'message' => 'Demande soumise avec succès! Le contrat a été envoyé à votre email.',
            
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de la soumission: '.$e->getMessage()
        ], 500);
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(Stage $stage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stage $stage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stage $stage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stage $stage)
    {
        //
    }

    public function dashClient()
    {
       $internshipRequests = Stage::with('user')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
        $requests = Stage::with('user')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
        return view('clients.layouts.dash.stage', compact('requests'));
    }

     public function download($id)
    {
        
    $request = Stage::findOrFail($id);
      $path = $request->contract_path;
        return Storage::download($path);
    }

      public function uploadSignedContract(Request $request)
    {
        $validated = $request->validate([
            'request_id' => 'required|exists:stages,id',
            'signed_contract' => 'required|file|mimes:pdf|max:2048'
        ]);

        try{
            
         $internship = Stage::find($validated['request_id']);
        
        $path = $request->file('signed_contract')->store('signed_contracts');
        
        $internship->update([
            'signed_contract_path' => $path,
            'status' => 'under_review'
        ]);

        // Envoi de la notification par email
        $clientName = session('clientInfo')->fist_name . ' ' . session('clientInfo')->last_name;

        Mail::to('serviceclient@cesiebenin.com')
            ->send(new ContratSigned($internship,$clientName));
           
        return redirect()->back()->with('success', 'Contrat signé envoyé avec succès!');
   
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'envoi du contrat signé: ' . $e->getMessage());
        }
   
     
    

        
    }
    
}

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
        'binome' => 'nullable|string|max:255',
        'message' => 'nullable|string|max:1000',
        'cip'   =>'required|file', // CIP n'est pas obligatoire
        'services' => 'nullable|array',
        'services.*' => 'string|max:255',
        'admin_culture_training' => 'required|in:oui,non'
    ]);

    try {
        // Stockage de la lettre de recommandation
        $recommendation_letter = $request->file('recommendation_letter')->store('recommendation_letters');
        $cipPath = $request->file('cip')->store('cips');
         
       
        // Récupération et préparation des services sélectionnés (multi-sélection)
        $servicesSelected = $request->input('services', []);
        $servicesString = is_array($servicesSelected) && count($servicesSelected) > 0
            ? implode(', ', $servicesSelected)
            : null;

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
            'services' => $servicesSelected ?: null,
            'recommendation_letter_path' => $recommendation_letter,
            'binome' => $validated['binome'] ?? null,
            'status' => 'pending',
            'cip' => $cipPath,
            'message' => (
                isset($validated['message']) && $validated['message'] !== ''
                    ? $validated['message']
                    : 'Aucun message fourni'
            ) . ' | Formation culture administrative: ' . ($validated['admin_culture_training'] === 'oui' ? 'Oui' : 'Non'),
          
             
        ]);

            // Générer la lettre de demande de stage
        $letterPath = $this->generateInternshipRequestLetter($internshipRequest);
        $internshipRequest->update(['letterPath' => $letterPath]);
        // 1. Chemin de l'image
        $imageSrc = 'https://pape.cesiebenin.com/clients/assets/images/all-img/image.png';
    
 
        // Génération du PDF
        $pdfData = [
            'imageSrc' => $imageSrc,
            'contract_id' => $internshipRequest->id,
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
    // Dans votre contrôleur ou service
public function generateInternshipRequestLetter($internshipRequest)
{
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        
        // Section principale
        $section = $phpWord->addSection();
        
        // En-tête
        $header = $section->addHeader();
        $header->addText('Lettre de Demande de Stage', ['bold' => true, 'size' => 16], ['alignment' => 'center']);
        
        // Contenu de la lettre
        $section->addTextBreak(2);
        
        // Date et lieu
        $section->addText('Fait à ' . $internshipRequest->commune . ', le ' . date('d/m/Y'));
        $section->addTextBreak(2);
        
        // Coordonnées de l'étudiant
        $section->addText($internshipRequest->user->client->fist_name);
        $section->addText($internshipRequest->university);
        $section->addText($internshipRequest->domaine . ' - ' . $internshipRequest->level);
        $section->addText('Tél: ' . ($internshipRequest->user->client->phone_number ?? 'Non renseigné'));
        $section->addText('Email: ' . $internshipRequest->user->email);
        $section->addTextBreak(2);
        
        // Destinataire
        $section->addText('À l\'attention de:');
        $section->addText('Responsable des stages');
        $section->addText($internshipRequest->company ?? 'Structure');
        $section->addText($internshipRequest->commune);
        $section->addTextBreak(2);
        
        // Objet
        $section->addText('Objet: Demande de stage', ['bold' => true]);
        $section->addTextBreak(1);
        
        // Corps de la lettre
        $letterText = "Madame, Monsieur,\n\n"
            . "Étudiant(e) en " . $internshipRequest->level . " à " . $internshipRequest->university . ", "
            . "je me permets de vous adresser ma candidature pour effectuer un stage au sein de votre entreprise.\n\n"
            . "Ce stage d'une durée de .$internshipRequest->duration. à compter du [date début] s'inscrit dans le cadre de ma formation "
            . "en " . $internshipRequest->domaine . ".\n\n"
            . "Votre entreprise, reconnue pour [spécialité de l'entreprise], représente à mes yeux "
            . "un cadre idéal pour parfaire mes connaissances et acquérir une expérience professionnelle enrichissante.\n\n"
            . "Je reste à votre disposition pour vous rencontrer afin de vous exposer plus en détail "
            . "ma motivation et mes compétences.\n\n"
            . "Dans l'attente de votre réponse, je vous prie d'agréer, Madame, Monsieur, "
            . "l'expression de mes salutations distinguées.";
        
        $section->addText($letterText);
        $section->addTextBreak(2);
        
        // Signature
        $section->addText('Signature:');
        $section->addText($internshipRequest->user->client->fist_name);
        
        $filename = 'Lettre_demande_stage_' . $internshipRequest->id . '.docx';
        $directory = 'public/letters/';

        // Créer le contenu du fichier
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        // Sauvegarde temporaire pour obtenir le contenu
        $tempPath = tempnam(sys_get_temp_dir(), 'phpword');
        $objWriter->save($tempPath);

        // Lire le contenu du fichier temporaire
        $fileContent = file_get_contents($tempPath);

        // Sauvegarder avec Storage
        Storage::put($directory . $filename, $fileContent);

        // Nettoyer le fichier temporaire
        unlink($tempPath);

        // Obtenir le chemin complet pour la base de données
        $filepath = Storage::path($directory . $filename);
        
        return $filepath;
}

public function downloadLetter($id)
{
    $internshipRequest = Stage::findOrFail($id);
    
    // Vérifier si le chemin existe
    if (!$internshipRequest->letterPath) {
        return redirect()->back()->with('error', 'La lettre de demande de stage n\'a pas encore été générée.');
    }
    
    // Extraire le nom de fichier du chemin complet
    $filename = basename($internshipRequest->letterPath);
    
    // Chemin relatif dans le storage
    $storagePath = 'letters/' . $filename;
    
    // Vérifier que le fichier existe
    if (!Storage::disk('public')->exists($storagePath)) {
        return redirect()->back()->with('error', 'Le fichier de la lettre est introuvable.');
    }
    
    // Télécharger le fichier
    return Storage::disk('public')->download($storagePath, $filename, [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ]);
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
            'signed_contract' => 'required|file|mimes:pdf'
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

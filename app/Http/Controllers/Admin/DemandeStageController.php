<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stage; 
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\Client; // Assurez-vous d'importer le modèle Client si nécessaire
use Illuminate\Support\Facades\Mail;
use App\Mail\StageApprouved; // Assurez-vous d'importer la classe StageApprouved


class DemandeStageController extends Controller
{
    //
    public function index()
{
    return view('admin.layouts.stage.stage'); // Doit retourner une vue, pas du JSON
}

    public function datatable(Request $request)
    {
      
         $requests = Stage::with('user.client') // Assurez-vous que le modèle Stage a une relation avec Client
            ->select('stages.*');
       
   
    return DataTables::of($requests)
        ->addColumn('download_url', function($request) {
            return route('internship.download', $request->id);
        })
        ->addColumn('details', function ($request) {
            return route('internships.show', $request->id);
        })
         ->addColumn('client', function ($request) {
        $client = $request->user?->client;
        return $client
            ? $client->first_name . ' ' . $client->last_name
            : 'Non renseigné';
    })
    ->rawColumns(['client'])
      
        ->toJson();
    }

    public function details($id)
        {
            $request = Stage::with('user.client')->findOrFail($id);
            return view('admin.layouts.stage.stage-details', compact('request'));
        }
   
    public function downloadSignedContract($id)
    {
        $stage = Stage::findOrFail($id);
        return Storage::download($stage->signed_contract_path);
    }

    public function downloadAuthorization($id)
    {
        $stage = Stage::findOrFail($id);
        return Storage::download($stage->authorization_path);
    }





    public function uploadAuthorization(Request $request)
{
    $validated = $request->validate([
        'stage_id' => 'required|exists:stages,id',
        'authorization_file' => 'required|file|mimes:pdf'
    ]);

    $internship = Stage::find($validated['stage_id']);
    
    // Stocker le fichier
    $path = $request->file('authorization_file')->store('authorizations');
    
    // Mettre à jour la demande
    $internship->update(['authorization_path' => $path,
            'status' => 'approved']);
    
    // Envoyer l'email
    Mail::to($internship->user->email)
        ->send(new StageApprouved($internship));
    
    return response()->json([
        'success' => true,
        'message' => 'Autorisation envoyée avec succès!'
    ]);
}
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\Stage;
use App\Mail\ProjectApprouved;
use Illuminate\Support\Facades\Mail;

class AdminProjectController extends Controller
{
    //
    public function index(){
        return view('admin.layouts.project.project');
    }

    public function datatable(Request $request){
       $requests =ProjectRequest::with('user.client')->select('project_requests.*');

       return DataTables::of($requests)
       ->addColumn('client', function ($request) {
           $client = $request->user?->client;
           return $client
               ? $client->fist_name . ' ' . $client->last_name
               : 'Non renseigné';
       })
       ->addColumn('details', function ($request) {
           return route('projects.details', $request->id);
       })
       ->rawColumns(['client'])
       ->toJson();
    }


       public function details($id)
        {
            $request = ProjectRequest::with('user.client')->findOrFail($id);
            return view('admin.layouts.project.project-details', compact('request'));
        }


        public function download($id)
        {
            $request = ProjectRequest::with('user.client')->findOrFail($id);
            
             return Storage::download($request->document_path);
        }

        public function uploadFinalFile(Request $request)
        {
           $validated = $request->validate([
        'project_id' => 'required|exists:project_requests,id',
        'final_file' => 'required|file|mimes:pdf'
    ]);

    $project = ProjectRequest::find($validated['project_id']);

    // Stocker le fichier
    $path = $request->file('final_file')->store('final_files');

    // Mettre à jour la demande
    $project->update(['file_path' => $path,
            'status' => 'approved']);

    // Envoyer l'email
    Mail::to($project->user->email)
        ->send(new ProjectApprouved($project));

    return response()->json([
        'success' => true,
        'message' => 'Fichier envoyé avec succès!'
    ]);


        }
}

<?php

namespace App\Http\Controllers\client;

use App\Models\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectReceived;
use App\Mail\NewProject;

class ProjectRequestController extends Controller
{
    public function create()
    {
        return view('clients.layouts.project.create');
    }

    public function dashClient()
    {

        $requests = ProjectRequest::where('user_id', Auth::id())->get();
        return view('clients.layouts.dash.project')->with('requests', $requests);
    }

    public function show(ProjectRequest $projectRequest)
    {
        $project = ProjectRequest::with('user.client')->findOrFail($projectRequest->id);
        return view('clients.layouts.dash.project_details', compact('project'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'problem' => 'required|string',
            'general_objective' => 'required|string',
            'specific_objectives' => 'required|string',
            'beneficiaries' => 'required|string',
            'partners' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'document' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Gestion du fichier
        $file = $request->file('document');
       
        $path = $file->store('project_documents');

        $projectRequest = ProjectRequest::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'problem' => $validated['problem'],
            'general_objective' => $validated['general_objective'],
            'specific_objectives' => $validated['specific_objectives'],
            'beneficiaries' => $validated['beneficiaries'],
            'partners' => $validated['partners'],
            'budget' => $validated['budget'],
            'document_path' => $path,
        ]);

                // Mail à l'administrateur
            Mail::to('serviceclient@cesiebenin.com')->send(new NewProject($projectRequest));
            
            // Mail à l'utilisateur
            Mail::to($projectRequest->user->email)->send(new ProjectReceived($projectRequest));

        return redirect()->route('project_request.confirmation', $projectRequest);
    }

    public function confirmation(ProjectRequest $projectRequest)
    {
        return view('clients.layouts.project.comfirmation', compact('projectRequest'));
    }
}

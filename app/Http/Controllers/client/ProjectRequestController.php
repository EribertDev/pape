<?php

namespace App\Http\Controllers\client;

use App\Models\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProjectRequestController extends Controller
{
    public function create()
    {
        return view('clients.layouts.project.create');
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
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/project_documents', $filename);

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

        return redirect()->route('project_request.confirmation', $projectRequest);
    }

    public function confirmation(ProjectRequest $projectRequest)
    {
        return view('clients.layouts.project.comfirmation', compact('projectRequest'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;


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
}

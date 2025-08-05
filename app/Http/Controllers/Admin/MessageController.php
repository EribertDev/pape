<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use App\Models\Message;
use App\Models\MessageUser;
use App\Models\UserDocument;


class MessageController extends Controller
{
    //
    public function index()
    {
        return view('admin.layouts.message.index');
    }


    public function searchUsers(Request $request)
    {   
        
        $query = $request->get('query'); // Récupère le mot-clé de recherche
        $client=Client::all();
       
        $data= Client::where('fist_name', 'like', '%' . $query . '%')->orWhere('last_name', 'like', '%' . $query . '%')->get();
        return response()->json($data);

    
   
    }


     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:file,link,info',
            'file' => 'required_if:type,file|file|max:10240',
            'link' => 'required_if:type,link',
            'content' => 'required_if:type,info',
            'visibility' => 'required|in:global,specific',
            'user_id' => 'required_if:visibility,specific|exists:users,id'
        ]);

            try{
                $data = [
                    'title' => $request->title,
                    'type' => $request->type,
                    'is_global' => $request->visibility === 'global'
                ];

                if ($request->visibility === 'specific') {
                    $data['user_id'] = $request->user_id;
                }

                // Gestion des différents types
                switch ($request->type) {
                    case 'file':
                        $file = $request->file('file');
                        $data['path'] = $file->store('user_documents');
                        $data['original_name'] = $file->getClientOriginalName();
                        break;
                        
                    case 'link':
                        $data['path'] = $request->link;
                       
                        break;
                        
                    case 'info':
                        $data['content'] = $request->content;
                         $data['type'] = 'information';
                        break;
                }

                UserDocument::create($data);

                return response()->json(['message' => 'Message envoyé avec succès',
                    'success' => true], 200);
            }catch(\Exception $e){
                return response()->json([
                    'error' => 'Une erreur est survenue lors de l\'envoi du message.',
                    'message' => $e->getMessage()
                ], 500);
                
            }

    }
}

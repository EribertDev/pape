<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\VideoCall;
use App\Events\VideoCallCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Notifications\VideoCallInvitation;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
class VideoCallController extends Controller
{
     public function create(Request $request, $commandeId)
    {
        $commande = Commande::with(['client'])->findOrFail($commandeId);
        
        // Vérifier les permissions
        $user = Auth::user();
       // if ($user->id != $commande->client->user_id && 
        //    $user->id != $commande->redacteur_id &&
         //   !$user->hasRole('admin')) {
        //    abort(403, 'Accès non autorisé');
       // }

        // Créer le salon de visioconférence
        $videoCall = VideoCall::create([
            'commande_id' => $commande->id,
            'created_by' => $user->id,
            'room_name' => 'commande-' . $commande->id . '-' . Str::random(8),
            'room_password' => Str::random(12),
            'starts_at' => now(),
            'duration' => $request->input('duration', 60),
            'admin_notified' => false
        ]);

        // Envoyer les notifications aux administrateurs
        $this->notifyAdmins($videoCall);

        return response()->json([
            'success' => true,
            'message' => 'Salon de visioconférence créé avec succès. Les administrateurs ont été notifiés.',
            'data' => [
                'video_call' => $videoCall,
                'join_url' => $videoCall->join_url
            ]
        ]);
    }

    public function join($videoCallId)
    {
        $videoCall = VideoCall::with(['commande', 'creator'])->findOrFail($videoCallId);
        $commande = $videoCall->commande;
        
        // Vérifier les permissions
        $user = Auth::user();
       // if ($user->id != $commande->client->user_id && 
        //    $user->id != $commande->redacteur_id &&
         //   !$user->hasRole('admin')) {
         //   abort(403, 'Accès non autorisé à cette visioconférence');
       // }

        // Ajouter l'utilisateur comme participant
        $videoCall->addParticipant($user->id, $user->name);

        return view('clients.layouts.video-call.embedded', compact('videoCall', 'user'));
    }

    public function listByCommande($commandeId)
    {
        $commande = Commande::findOrFail($commandeId);
        
        // Vérifier les permissions
        $user = Auth::user();
        if ($user->id != $commande->client->user_id && 
            $user->id != $commande->redacteur_id &&
            !$user->hasRole('admin')) {
            abort(403, 'Accès non autorisé');
        }

        $videoCalls = VideoCall::where('commande_id', $commandeId)
            ->with(['creator', ])
            ->orderBy('created_at', 'desc')
            ->get();
        

        return response()->json([
            'success' => true,
            'data' => $videoCalls
        ]);
    }

    public function adminIndex()
    {
        // Vérifier que l'utilisateur est admin
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Accès réservé aux administrateurs');
        }

        $videoCalls = VideoCall::with(['creator', 'participants', 'commande'])
            ->where('commande_id', $commandeId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.video-calls.index', compact('videoCalls'));
    }

    public function adminShow($videoCallId)
    {
        // Vérifier que l'utilisateur est admin
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Accès réservé aux administrateurs');
        }

        $videoCall = VideoCall::with(['commande', 'creator'])->findOrFail($videoCallId);

        return view('admin.video-calls.show', compact('videoCall'));
    }

    private function notifyAdmins(VideoCall $videoCall)
    {
        // Récupérer tous les administrateurs
        $admins = User::where ('id',33)->get(); // Remplacez cette ligne par la logique appropriée pour récupérer les admins

        // Envoyer les notifications
        Notification::send($admins, new VideoCallInvitation($videoCall));

        // Marquer comme notifié
        $videoCall->markAsNotified();

        return true;
    }

   
    public function end($videoCallId)
    {
        $videoCall = VideoCall::findOrFail($videoCallId);
        
        // Vérifier les permissions
        $user = Auth::user();
        if ($user->id != $videoCall->created_by && !$user->hasRole('admin')) {
            abort(403, 'Seul le créateur peut terminer la visioconférence');
        }

        $videoCall->update([
            'ends_at' => now(),
            'is_active' => false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Visioconférence terminée avec succès'
        ]);
    }


    public function leave($videoCallId)
    {
        $videoCall = VideoCall::findOrFail($videoCallId);
        $user = Auth::user();
        
        $videoCall->removeParticipant($user->id);
        
        return response()->json([
            'success' => true,
            'message' => 'Participant removed'
        ]);
    }



     // Afficher la page avec l'éditeur
    public function showWithEditor($commandeId)
    {
        $commande = Commande::findOrFail($commandeId);
        $documents = [];
        $documentsPath = storage_path("app/collaborative-docs/{$commandeId}");
        $videoCall = VideoCall::with(['commande', 'creator'])->findOrFail(12);
        
        if (file_exists($documentsPath)) {
            $files = scandir($documentsPath);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $documents[] = [
                        'name' => $file,
                        'url' => Storage::url("collaborative-docs/{$commandeId}/{$file}")
                    ];
                }
            }
        }
        
        return view('clients.layouts.video-call.embedded', compact('commande', 'documents','videoCall'));
    }
    

  

        public function uploadDocument(Request $request, $commandeId)
    {
        try {
            $request->validate([
                'document' => 'required|file|mimes:doc,docx|max:10240'
            ]);
            
            $file = $request->file('document');
            $originalName = $file->getClientOriginalName();
            $fileName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            
            // Utiliser le disk 'collaborative'
            $directory = "{$commandeId}";
            
            // Stocker le fichier avec le disk collaborative
            $path = $file->storeAs($directory, $fileName, 'collaborative');
            
            return response()->json([
                'success' => true,
                'message' => 'Document téléchargé avec succès',
                'document' => [
                    'name' => $fileName,
                    'original_name' => $originalName,
                    'url' => Storage::disk('collaborative')->url("{$commandeId}/{$fileName}"),
                    'size' => $file->getSize(),
                    'path' => $path
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du téléchargement: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function listDocuments($commandeId)
    {
        try {
            $documents = [];
            $directory = "public/collaborative-docs/{$commandeId}";
            
            if (Storage::exists($directory)) {
                $files = Storage::files($directory);
                
                foreach ($files as $file) {
                    // Ignorer les fichiers cachés
                    if (strpos(basename($file), '.') === 0) {
                        continue;
                    }
                    
                    $documents[] = [
                        'name' => basename($file),
                        'url' => Storage::url($file),
                        'size' => Storage::size($file),
                        'modified' => Storage::lastModified($file),
                        'full_path' => $file
                    ];
                }
            }
            
            return response()->json([
                'success' => true,
                'documents' => $documents
            ], 200, [
                'Content-Type' => 'application/json; charset=utf-8'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage(),
                'documents' => []
            ], 500, [
                'Content-Type' => 'application/json; charset=utf-8'
            ]);
        }
    }
    
 public function getEditUrl($commandeId, $documentName)
    {
        try {
            $documentName = urldecode($documentName);
            // CHEMIN CORRECT
            $filePath = storage_path("app/public/collaborative-docs/{$commandeId}/{$documentName}");
            
            if (!file_exists($filePath)) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Document non trouvé à: ' . $filePath
                ], 404);
            }
            
            $documentUrl = url("/storage/collaborative-docs/{$commandeId}/{$documentName}");
            $editUrl = "https://view.officeapps.live.com/op/embed.aspx?src=" . urlencode($documentUrl);
            
            return response()->json([
                'success' => true,
                'editUrl' => $editUrl,
                'directUrl' => $documentUrl
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function deleteDocument($commandeId, $documentName)
    {
        try {
            $path = "public/collaborative-docs/{$commandeId}/" . urldecode($documentName);
            
            if (Storage::exists($path)) {
                Storage::delete($path);
                return response()->json([
                    'success' => true, 
                    'message' => 'Document supprimé avec succès'
                ], 200, [
                    'Content-Type' => 'application/json; charset=utf-8'
                ]);
            }
            
            return response()->json([
                'success' => false, 
                'message' => 'Document non trouvé'
            ], 404, [
                'Content-Type' => 'application/json; charset=utf-8'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression: ' . $e->getMessage()
            ], 500, [
                'Content-Type' => 'application/json; charset=utf-8'
            ]);
        }
    }




    
}
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
}
<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RemoteControlController extends Controller
{
    public function requestControl(Request $request)
    {
        $validated = $request->validate([
            'offer' => 'required|array',
            'session_id' => 'required|string'
        ]);
        
        $requestId = uniqid('remote_', true);
        
        // Stocker la demande en cache (valable 5 minutes)
        Cache::put('remote_request_' . $requestId, [
            'offer' => $validated['offer'],
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->email,
            'session_id' => $validated['session_id'],
            'status' => 'pending',
            'created_at' => now()
        ], 300);
        
        // Ici, vous notifieriez l'administrateur ou l'autre utilisateur
        // via WebSockets ou une autre méthode
        
        return response()->json([
            'success' => true,
            'request_id' => $requestId,
            'message' => 'Demande de contrôle envoyée'
        ]);
    }
    
    public function getRequestStatus($requestId)
    {
        $request = Cache::get('remote_request_' . $requestId);
        
        if (!$request) {
            return response()->json([
                'success' => false,
                'message' => 'Demande non trouvée'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'status' => $request['status'],
            'answer' => $request['answer'] ?? null
        ]);
    }
    
    public function acceptRequest($requestId)
    {
        $request = Cache::get('remote_request_' . $requestId);
        
        if (!$request) {
            return response()->json([
                'success' => false,
                'message' => 'Demande non trouvée'
            ], 404);
        }
        
        // Créer une réponse WebRTC
        // Note: Ceci est une simplification
        $answer = [
            'type' => 'answer',
            'sdp' => '...' // Générer une réponse SDP réelle ici
        ];
        
        // Mettre à jour la demande
        $request['status'] = 'accepted';
        $request['answer'] = $answer;
        Cache::put('remote_request_' . $requestId, $request, 300);
        
        return response()->json([
            'success' => true,
            'message' => 'Demande acceptée'
        ]);
    }
    
    public function rejectRequest($requestId)
    {
        $request = Cache::get('remote_request_' . $requestId);
        
        if (!$request) {
            return response()->json([
                'success' => false,
                'message' => 'Demande non trouvée'
            ], 404);
        }
        
        // Mettre à jour la demande
        $request['status'] = 'rejected';
        Cache::put('remote_request_' . $requestId, $request, 300);
        
        return response()->json([
            'success' => true,
            'message' => 'Demande rejetée'
        ]);
    }
    
    public function getPendingRequests()
    {
        $requests = [];
        $keys = Cache::get('remote_request_keys', []);
        
        foreach ($keys as $key) {
            if (str_starts_with($key, 'remote_request_')) {
                $request = Cache::get($key);
                if ($request && $request['status'] === 'pending') {
                    $request['id'] = str_replace('remote_request_', '', $key);
                    $requests[] = $request;
                }
            }
        }
        
        return response()->json([
            'success' => true,
            'requests' => $requests
        ]);
    }
    
    public function handleSignal(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'candidate' => 'required_if:type,ice-candidate|array',
            'sdp' => 'required_if:type,offer|array'
        ]);
        
        // Traiter le signal WebRTC
        // Cette implémentation varie considérablement selon votre architecture
        
        return response()->json([
            'success' => true,
            'message' => 'Signal traité'
        ]);
    }
    
    public function endSession(Request $request)
    {
        // Nettoyer la session de contrôle
        $sessionId = $request->input('session_id');
        
        // Ici, vous nettoieriez les ressources associées à cette session
        
        return response()->json([
            'success' => true,
            'message' => 'Session terminée'
        ]);
    }
    // Récupérer les détails d'une demande spécifique
public function getRequestDetails($requestId)
{
    try {
        $cacheKey = 'remote_request_' . $requestId;
        $requestData = Cache::get($cacheKey);
        
        if (!$requestData) {
            return response()->json([
                'success' => false,
                'message' => 'Demande non trouvée'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'request' => $requestData
        ]);
        
    } catch (\Exception $e) {
        Log::error('Erreur récupération détails demande: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Erreur serveur'
        ], 500);
    }
}

// Traiter une commande de contrôle
public function handleControlCommand(Request $request, $requestId)
{
    try {
        $validated = $request->validate([
            'command' => 'required|string',
            'parameters' => 'sometimes|array'
        ]);
        
        $cacheKey = 'remote_request_' . $requestId;
        $requestData = Cache::get($cacheKey);
        
        if (!$requestData || $requestData['status'] !== 'accepted') {
            return response()->json([
                'success' => false,
                'message' => 'Session non valide'
            ], 400);
        }
        
        // Ici, vous enverriez la commande à l'ordinateur distant
        // Pour cet exemple, nous allons simplement logger la commande
        Log::info('Commande de contrôle', [
            'request_id' => $requestId,
            'command' => $validated['command'],
            'parameters' => $validated['parameters'] ?? []
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Commande exécutée'
        ]);
        
    } catch (\Exception $e) {
        Log::error('Erreur traitement commande: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Erreur serveur'
        ], 500);
    }
}

// Terminer une session de contrôle
public function endControlSession($requestId)
{
    try {
        $cacheKey = 'remote_request_' . $requestId;
        $requestData = Cache::get($cacheKey);
        
        if ($requestData) {
            // Mettre à jour le statut
            $requestData['status'] = 'ended';
            $requestData['ended_at'] = now();
            
            Cache::put($cacheKey, $requestData, 60); // Garder encore 1 minute
            
            // Nettoyer la liste des clés
            $this->cleanupRequestKeys();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Session terminée'
        ]);
        
    } catch (\Exception $e) {
        Log::error('Erreur fin de session: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Erreur serveur'
        ], 500);
    }
}
}
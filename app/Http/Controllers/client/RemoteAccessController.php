<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class RemoteAccessController extends Controller
{
    // Afficher l'interface principale
    public function index()
    {
        return view('remote-access.index');
    }

    // Créer une nouvelle session de contrôle
    public function createSession(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'user_name' => 'required|string'
        ]);

        $sessionId = Str::random(12);
        $data = [
            'id' => $sessionId,
            'requester' => [
                'id' => $request->user_id,
                'name' => $request->user_name
            ],
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ];

        // Stocker la session pendant 10 minutes
        Cache::put('remote_session_' . $sessionId, $data, 600);

        return response()->json([
            'success' => true,
            'session_id' => $sessionId,
            'message' => 'Session créée avec succès'
        ]);
    }

    // Récupérer le statut d'une session
    public function getSessionStatus($sessionId)
    {
        $session = Cache::get('remote_session_' . $sessionId);

        if (!$session) {
            return response()->json([
                'success' => false,
                'message' => 'Session non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'session' => $session
        ]);
    }

    // Gérer la réponse à une demande
    public function handleResponse(Request $request, $sessionId)
    {
        $request->validate([
            'response' => 'required|in:accepted,rejected',
            'user_id' => 'required|string',
            'user_name' => 'required|string'
        ]);

        $session = Cache::get('remote_session_' . $sessionId);

        if (!$session) {
            return response()->json([
                'success' => false,
                'message' => 'Session non trouvée'
            ], 404);
        }

        if ($session['status'] !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'La session a déjà été traitée'
            ], 400);
        }

        // Mettre à jour la session
        $session['status'] = $request->response;
        $session['responder'] = [
            'id' => $request->user_id,
            'name' => $request->user_name
        ];
        $session['updated_at'] = now();

        Cache::put('remote_session_' . $sessionId, $session, 600);

        return response()->json([
            'success' => true,
            'message' => 'Réponse enregistrée avec succès'
        ]);
    }

    // Terminer une session
    public function endSession(Request $request, $sessionId)
    {
        $session = Cache::get('remote_session_' . $sessionId);

        if (!$session) {
            return response()->json([
                'success' => false,
                'message' => 'Session non trouvée'
            ], 404);
        }

        // Marquer la session comme terminée
        $session['status'] = 'ended';
        $session['ended_at'] = now();
        Cache::put('remote_session_' . $sessionId, $session, 60); // Garder 1 minute après la fin

        return response()->json([
            'success' => true,
            'message' => 'Session terminée'
        ]);
    }

    // Gérer les signaux WebRTC
    public function handleSignal(Request $request)
    {
        $request->validate([
            'session_id' => 'required|string',
            'signal' => 'required|array',
            'type' => 'required|in:offer,answer,ice-candidate'
        ]);

        $sessionId = $request->session_id;
        $session = Cache::get('remote_session_' . $sessionId);

        if (!$session) {
            return response()->json([
                'success' => false,
                'message' => 'Session non trouvée'
            ], 404);
        }

        // Stocker le signal pour qu'il soit récupéré par l'autre pair
        $signals = Cache::get('remote_signals_' . $sessionId, []);
        $signals[] = [
            'type' => $request->type,
            'signal' => $request->signal,
            'timestamp' => now()
        ];
        Cache::put('remote_signals_' . $sessionId, $signals, 600);

        return response()->json([
            'success' => true,
            'message' => 'Signal traité'
        ]);
    }

    // Récupérer les signaux pour une session
    public function getSession($sessionId)
    {
        $session = Cache::get('remote_session_' . $sessionId);
        $signals = Cache::get('remote_signals_' . $sessionId, []);

        if (!$session) {
            return response()->json([
                'success' => false,
                'message' => 'Session non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'session' => $session,
            'signals' => $signals
        ]);
    }
}
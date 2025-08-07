<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     * @throws ValidationException
     */
    public function store(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        // Authentifie l'utilisateur
        $request->authenticate();
        // Regénère la session pour éviter les attaques CSRF
        $request->session()->regenerate();
        // Vérifie si l'authentification a réussi
        if (Auth::check()) {
            $user = Auth::user(); // Récupère l'utilisateur connecté
            $role = Role::getNameById($user->roles_id); // Récupère le rôle
            session()->put('user_status', Status::getNameById($user->status_id));
            session()->put('role', $role);
            // Gestion pour les clients
            if ($role === "Client") {
                $client = (new Client())->getClientByUserId($user->id);
                if ($client) {
                    session()->put('client_statut', Status::getNameById($client->status_id));
                    session()->put('clientInfo', $client);
                }
                else {
                    return response()->json(['msg' => 'Client introuvable', 'success' => false, 'data' => []], 422);
                }
                // Gestion pour les administrateurs
            } else {
                $admin = (new Admin())->getAdminByUserId($user->id);
                if ($admin) {
                    session()->put('admin_statut', Status::getNameById($admin->status_id));
                    session()->put('adminInfo', $admin);
                } else {
                    return response()->json(['msg' => 'Administrateur introuvable', 'success' => false, 'data' => []], 422);
                }
            }
            // Réponse en cas de succès
            return response()->json(['msg' => 'successfully', 'success' => true, 'data' => ['role' => $role]], 200);
        }
        // Réponse en cas d'échec d'authentification
        return response()->json(['msg' => 'Échec', 'success' => false, 'data' => ['role' => '']], 422);
    }
    /**
     * Destroy an authenticated session.
     * 
     * 
     * 
     * 
     * 
     */


    protected function getRedirectUrlByRole(string $role, int $userId): ?string
{
    switch ($role) {
        case 'Client':
            $client = (new Client())->getClientByUserId($userId);
            if (!$client) return null;
            
            session()->put([
                'client_statut' => Status::getNameById($client->status_id),
                'clientInfo' => $client
            ]);
            return '/home';
            
        case 'Administrateur':
        case 'Editeur':
        case 'Affilier':
        case 'Super Admin':
        case 'Gestionnaire':
            $admin = (new Admin())->getAdminByUserId($userId);
            if (!$admin) return null;
            
            session()->put([
                'admin_statut' => Status::getNameById($admin->status_id),
                'adminInfo' => $admin
            ]);
            return '/admin/dash';
            
        default:
            return '/home';
    }
}
    public function destroy(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        session()->forget('clientInfo');
        session()->forget('user_status');
        session()->forget('role');
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}

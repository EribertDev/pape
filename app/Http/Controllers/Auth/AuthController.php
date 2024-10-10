<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function registerClient(Request $request): JsonResponse
    {
        $request->merge(['email' => $request->input('_email')]);
        $request->merge(['password' => $request->input('_password')]);
        $clientInfo = $request->validate([
            'phone_number' =>['required','Integer'],
            'last_name'  => ['required', 'string', 'max:255'],
            'fist_name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
        ], [
            'phone_number.required' => 'Le numéro de téléphone est requis.',
            'phone_number.integer' => 'Le numéro de téléphone doit être un nombre entier.',
            'last_name.required' => 'Le nom de famille est requis.',
            'last_name.max' => 'Le nom de famille ne peut pas dépasser 255 caractères.',
            'first_name.required' => 'Le prénom est requis.',
            'first_name.max' => 'Le prénom ne peut pas dépasser 255 caractères.',
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'Veuillez entrer une adresse e-mail valide.',
            'email.max' => 'L\'adresse e-mail ne peut pas dépasser 255 caractères.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'password.required' => 'Le mot de passe est requis.',
        ]);

        try {
            $client = new User();
            $idClient = $client->addNewClient($clientInfo);
            return response()->json(["message"=>"success","data"=>$idClient]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e
            ], 500);
        }
    }
}

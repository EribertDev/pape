<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClientProfileController extends Controller
{
    //
    public function index(){

        return view('clients.layouts.dash.profile');
    }

    public function profileUpdate(Request $request): \Illuminate\Http\JsonResponse
    {

        $clientInfo = $request->validate([
            'phone_number' =>['required','Integer'],
            'last_name'  => ['required', 'string', 'max:255'],
            'fist_name'  => ['required', 'string', 'max:255'],
           /* 'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],*/
        ]);

        try {

            $idClient = (new Client())->updateClient(session()->get('clientInfo')->id,$clientInfo);
            if ($idClient){
                $client = (new Client())->getClientByUserId(Auth::id());
                Session::put('client_statut',Status::getNameById($client->status_id));
                Session::put('clientInfo', $client);
            }
            return response()->json(["message"=>"success","data"=>$client]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e
            ], 500);
        }
    }
}

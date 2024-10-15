<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    //
    public function index(){

        $membres = (new Admin())->getAllPargination(12);
        $roles = Role::getEverythingExceptWhere('name',[/*'Administrateur',*/'Super Admin','client']);
       // dd($membres);
      //  dd($membres);
        $data = ["membres"=>$membres,"roles"=>$roles];
        return view("admin.layouts.staff.staff")->with("data",$data);
    }
    //
    public  function addMember(Request $request){
        $role_id = $request->input("role");
        // Définissez les règles de validation de base
        $validationRules = [
            "lastName" => "required",
            "firstName" => "required",
            "email" => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class
            ],
            "phoneNumber" => "required",
            "password" => "required"
        ];

        // Ajoutez la règle pour 'codeaf' si le rôle est 'Affilier'
        if (Status::getNameById($role_id) === "Affilier") {
            $validationRules["codeaf"] = "required";
        }

        // Validez les données avec les messages d'erreur
        $validate = $request->validate($validationRules, [
            'lastName.required' => 'Le nom de famille est requis.',
            'firstName.required' => 'Le prénom est requis.',
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail doit être une adresse valide.',
            'email.lowercase' => 'L\'adresse e-mail doit être en minuscules.',
            'email.max' => 'L\'adresse e-mail ne peut pas dépasser 255 caractères.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'phoneNumber.required' => 'Le numéro de téléphone est requis.',
            'password.required' => 'Le mot de passe est requis.',
            'codeaf.required' => 'Le code d\'affiliation est requis.' // Message d'erreur pour codeaf
        ]);


        $response =  (new User())->addNewMember([
            "fist_name"=>$request->input("firstName"),
            "last_name"=>$request->input("lastName"),
            "phone_number"=>$request->input("phoneNumber"),
            "email"=>$request->input("email"),
            "bio"=>$request->input("bio"),
            "roles_id"=>$role_id,
            "password"=>$request->input("password"),
            "code_af"=>$request->input("codeaf"),
        ]);
        if ($response){
            return response()->json(['message'=>'success'],200);
        }
        return response()->json(['message'=>'echec'],200);
    }
    //
    public function getMembre(Request $request){
            $reference = $request->input("reference");
            $member = (new Admin())->getByReference($reference);
            $member=$member->toArray();
            unset($member["id"], $member["status_id"],$member["user_id"],$member["user"]['id'],$member["status"]);
            return response()->json($member);
    }
    //
    public function lockedMember(Request $request){

       // return response()->json($member);
    }

}

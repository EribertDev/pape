<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    //
    public function index(){

        $membres = (new Admin())->getAllPargination(12);
        $roles = Role::getEverythingExceptWhere('name',['Administrateur','Super Admin','client']);
      //  dd($membres);
        $data = ["membres"=>$membres,"roles"=>$roles];
        return view("admin.layouts.staff.staff")->with("data",$data);
    }
    //
    public  function addMember(Request $request){
        $validate = $request->validate([
                "lastName"=>"required",
                "firstName"=>"required",
                "email"=>"required",
                "phoneNumber"=>"required",
        ]);
        $response =  (new User())->addNewMember([
            "fist_name"=>$request->input("firstName"),
            "last_name"=>$request->input("lastName"),
            "phone_number"=>$request->input("phoneNumber"),
            "email"=>$request->input("email"),
            "bio"=>$request->input("bio"),
            "roles_id"=>$request->input("role"),
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

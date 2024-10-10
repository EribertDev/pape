<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\ThemeMemoire;
use Illuminate\Http\Request;

class ThemeMemoireController extends Controller
{
    //
    public function index(){
        $ctg = Categorie::getAll();
        $tms = (new ThemeMemoire())->getAll();
        $data = ["tms"=>$tms,"ctg"=>$ctg];
        return view('clients.layouts.theme-memoires.theme-memoire')->with('data',$data);
    }
}

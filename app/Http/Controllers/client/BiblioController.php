<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\ThemeMemoire;

class BiblioController extends Controller
{
    //
    public function index(){
        
        $themes = ThemeMemoire::where('status_id', 1)->get();

    
        return view('clients.layouts.biblio.index', compact('themes'));
    }
}

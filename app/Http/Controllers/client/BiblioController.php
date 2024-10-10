<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;

class BiblioController extends Controller
{
    //
    public function index(){
        return view('clients.layouts.biblio.index');
    }
}

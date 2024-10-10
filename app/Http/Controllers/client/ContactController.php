<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    //
    public function index(){
        return view('clients.layouts.contact.contact');
    }
}

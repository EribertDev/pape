<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDocument;
use Illuminate\Support\Facades\Auth;
class MessageController extends Controller
{
    //

    public function index()
{
    $documents = UserDocument::forUser(Auth::id())
        ->latest()
        ->get();

    return view('clients.layouts.dash.message', compact('documents'));
}
}

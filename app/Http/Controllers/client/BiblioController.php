<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\ThemeMemoire;
use Illuminate\Http\Request;

class BiblioController extends Controller
{
    //
    public function index(){
        
        $themes = ThemeMemoire::where('status_id', 1)->get();

    
        return view('clients.layouts.biblio.index', compact('themes'));
    }

    public function search(Request $request)
{
    $query = $request->get('query'); // Récupère le mot-clé de recherche
    $themes = ThemeMemoire::where('status_id', 1) // Condition pour les thèmes actifs
    ->where(function ($queryBuilder) use ($query) {
        $queryBuilder->where('title', 'like', '%' . $query . '%')
                     ->orWhere('description', 'like', '%' . $query . '%');
    })
    ->get();

    return response()->json($themes); // Renvoie les thèmes au format JSON
}

      
public function getFavorites(Request $request)
{
    // Récupérer les favoris à partir de la session
    $favorites = $request->session()->get('favorites', []);

    // Répondre avec les favoris en format JSON
    return response()->json($favorites);
}

}

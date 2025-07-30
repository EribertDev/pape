<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\ThemeMemoire;
use Illuminate\Http\Request;
use App\Models\Discipline;

class BiblioController extends Controller
{
    //
    public function index(){
        
        $themes = ThemeMemoire::where('status_id', 1)->with('discipline')->get();
        $disciplines = Discipline::all();

    
        return view('clients.layouts.biblio.index', compact('themes', 'disciplines'));
    }

    public function searchThemes(Request $request)
{
    $query = $request->get('query'); // Récupère le mot-clé de recherche
    $currentSpecialty = $request->get('specialty', 'all'); // Récupère la spécialité actuelle, par défaut 'all'
   
    $themes = ThemeMemoire::where('status_id', 1)
    ->when($currentSpecialty !== 'all', function ($query) use ($currentSpecialty) {
        $query->where('discipline_id', $currentSpecialty);
    })
    ->where(function ($queryBuilder) use ($query, $currentSpecialty) {
        $queryBuilder->where('title', 'like', '%' . $query . '%')
          ->when($currentSpecialty !== 'all', function ($query) use ($currentSpecialty) {
        $query->where('discipline_id', $currentSpecialty);
    })           
                     ->orWhere('description', 'like', '%' . $query . '%');
    })
    ->get();

    return response()->json($themes); // Renvoie les thèmes au format JSON
}
public function filterThemes(Request $request)
{
     $query = ThemeMemoire::query();
    
    if ($request->has('specialty') && $request->specialty !== 'all') {
        $query->where('discipline_id', $request->specialty);
    }
    
    if ($request->has('query')) {
        $query->where('title', 'like', '%'.$request->query.'%');
    }
    
    return $query->with('discipline')->get();
}

      
public function getFavorites(Request $request)
{
    // Récupérer les favoris à partir de la session
    $favorites = $request->session()->get('favorites', []);

    // Répondre avec les favoris en format JSON
    return response()->json($favorites);
}

}

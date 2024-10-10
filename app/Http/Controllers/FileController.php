<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //

    public function storeFileTemp(Request $request){

        // Validation des fichiers
        $request->validate([
            'file' => 'required|file|max:2048' // 2 MB max
        ]);

        // Définir le disque et le chemin de stockage
        $disk = 'local';
        $path = 'public/tmp/uploads';

        // Vérifier et créer le répertoire si nécessaire
        if (!Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->makeDirectory($path);
        }

        // Obtenir le fichier de la requête
        $file = $request->file('file');

        // Générer un nom unique pour le fichier
        $name = uniqid('', true) . '_' . trim($file->getClientOriginalName());

        // Déplacer le fichier
        $filePath = $file->storeAs($path, $name, $disk);

        // Obtenir le chemin complet du fichier
        $fullPath = Storage::disk($disk)->path($filePath);

        // Récupérer les informations de session actuelles ou initialiser un tableau vide
        $uploadedFiles = Session::get('tmp_files', []);

        // Ajouter les informations du fichier au tableau de session
        $uploadedFiles[] = [
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
            'path' => $filePath,
        ];
        // Mettre à jour la session avec les nouvelles informations de fichier
        Session::put('tmp_files', $uploadedFiles);

        // Retourner la réponse JSON avec le chemin du fichier
       // return response()->json(['allfils'=>Session::get('tmp_files')]);
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
            'path'          => $filePath,
            'full_path'     => $fullPath
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFileTemp(Request $request): JsonResponse
    {
        // Récupérer le nom du fichier à supprimer
        $fileName = $request->input('name');

        // Récupérer les informations de fichiers de la session
       $uploadedFiles = Session::get('tmp_files', []);

        // Filtrer les fichiers pour supprimer celui correspondant au nom

        // Filtrer les fichiers pour supprimer celui correspondant au nom
        $updatedFiles = array_filter($uploadedFiles, function($file) use ($fileName) {
            return $file['name'] !== $fileName;
        });
        // Réinitialiser les clés du tableau après la suppression
        $updatedFiles = array_values($updatedFiles);
        // Mettre à jour la session avec le tableau modifié
        Session::put('tmp_files', $updatedFiles);
        // Supprime le fichier du stockage temporaire
        if (Storage::exists('public/tmp/uploads/' . $fileName)) {
            Storage::delete('public/tmp/uploads/' . $fileName);
            return response()->json(['success' => true,'file'=> $fileName,'allfils'=>Session::get('tmp_files')]);
        }
        return response()->json(['success' => false, 'message' => 'Fichier introuvable.','allfils'=>Session::get('tmp_files')]);
    }
}

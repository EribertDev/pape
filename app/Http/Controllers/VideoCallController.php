<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\VideoCall;
use App\Events\VideoCallCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Notifications\VideoCallInvitation;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html as PhpWordHtml;
class VideoCallController extends Controller
{
     public function create(Request $request, $commandeId)
    {
        $commande = Commande::with(['client'])->findOrFail($commandeId);
        
        // Vérifier les permissions
        $user = Auth::user();
       // if ($user->id != $commande->client->user_id && 
        //    $user->id != $commande->redacteur_id &&
         //   !$user->hasRole('admin')) {
        //    abort(403, 'Accès non autorisé');
       // }

        // Créer le salon de visioconférence
        $videoCall = VideoCall::create([
            'commande_id' => $commande->id,
            'created_by' => $user->id,
            'room_name' => 'commande-' . $commande->id . '-' . Str::random(8),
            'room_password' => Str::random(12),
            'starts_at' => now(),
            'duration' => $request->input('duration', 60),
            'admin_notified' => false
        ]);

        // Envoyer les notifications aux administrateurs
        $this->notifyAdmins($videoCall);

        return response()->json([
            'success' => true,
            'message' => 'Salon de visioconférence créé avec succès. Les administrateurs ont été notifiés.',
            'data' => [
                'video_call' => $videoCall,
                'join_url' => $videoCall->join_url
            ]
        ]);
    }

    public function join($videoCallId)
    {
        $videoCall = VideoCall::with(['commande', 'creator'])->findOrFail($videoCallId);
        $commande = $videoCall->commande;
        
        // Vérifier les permissions
        $user = Auth::user();
       // if ($user->id != $commande->client->user_id && 
        //    $user->id != $commande->redacteur_id &&
         //   !$user->hasRole('admin')) {
         //   abort(403, 'Accès non autorisé à cette visioconférence');
       // }

        // Ajouter l'utilisateur comme participant
        $videoCall->addParticipant($user->id, $user->name);

        return view('clients.layouts.video-call.embedded', compact('videoCall', 'user'));
    }

    public function listByCommande($commandeId)
    {
        $commande = Commande::findOrFail($commandeId);
        
        // Vérifier les permissions
        $user = Auth::user();
        if ($user->id != $commande->client->user_id && 
            $user->id != $commande->redacteur_id &&
            !$user->hasRole('admin')) {
            abort(403, 'Accès non autorisé');
        }

        $videoCalls = VideoCall::where('commande_id', $commandeId)
            ->with(['creator', ])
            ->orderBy('created_at', 'desc')
            ->get();
        

        return response()->json([
            'success' => true,
            'data' => $videoCalls
        ]);
    }

    public function adminIndex()
    {
        // Vérifier que l'utilisateur est admin
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Accès réservé aux administrateurs');
        }

        $videoCalls = VideoCall::with(['creator', 'participants', 'commande'])
            ->where('commande_id', $commandeId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.video-calls.index', compact('videoCalls'));
    }

    public function adminShow($videoCallId)
    {
        // Vérifier que l'utilisateur est admin
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Accès réservé aux administrateurs');
        }

        $videoCall = VideoCall::with(['commande', 'creator'])->findOrFail($videoCallId);

        return view('admin.video-calls.show', compact('videoCall'));
    }

    private function notifyAdmins(VideoCall $videoCall)
    {
        // Récupérer tous les administrateurs
        $admins = User::where ('id',33)->get(); // Remplacez cette ligne par la logique appropriée pour récupérer les admins

        // Envoyer les notifications
        Notification::send($admins, new VideoCallInvitation($videoCall));

        // Marquer comme notifié
        $videoCall->markAsNotified();

        return true;
    }

   
    public function end($videoCallId)
    {
        $videoCall = VideoCall::findOrFail($videoCallId);
        
        // Vérifier les permissions
        $user = Auth::user();
        if ($user->id != $videoCall->created_by && !$user->hasRole('admin')) {
            abort(403, 'Seul le créateur peut terminer la visioconférence');
        }

        $videoCall->update([
            'ends_at' => now(),
            'is_active' => false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Visioconférence terminée avec succès'
        ]);
    }


    public function leave($videoCallId)
    {
        $videoCall = VideoCall::findOrFail($videoCallId);
        $user = Auth::user();
        
        $videoCall->removeParticipant($user->id);
        
        return response()->json([
            'success' => true,
            'message' => 'Participant removed'
        ]);
    }



     // Afficher la page avec l'éditeur
    public function showWithEditor($commandeId)
    {
        $commande = Commande::findOrFail($commandeId);
        $documents = [];
        $documentsPath = storage_path("app/collaborative-docs/{$commandeId}");
        $videoCall = VideoCall::with(['commande', 'creator'])->findOrFail(12);
        
        if (file_exists($documentsPath)) {
            $files = scandir($documentsPath);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $documents[] = [
                        'name' => $file,
                        'url' => Storage::url("collaborative-docs/{$commandeId}/{$file}")
                    ];
                }
            }
        }
        
        return view('clients.layouts.video-call.embedded', compact('commande', 'documents','videoCall'));
    }
    

  

        public function uploadDocument(Request $request, $commandeId)
    {
        try {
            $request->validate([
                'document' => 'required|file|mimes:doc,docx|max:10240'
            ]);
            
            $file = $request->file('document');
            $originalName = $file->getClientOriginalName();
            $fileName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            
            // Utiliser le disk 'collaborative'
            $directory = "{$commandeId}";
            
            // Stocker le fichier avec le disk collaborative
            $path = $file->storeAs($directory, $fileName, 'collaborative');
            
            return response()->json([
                'success' => true,
                'message' => 'Document téléchargé avec succès',
                'document' => [
                    'name' => $fileName,
                    'original_name' => $originalName,
                    'url' => Storage::disk('collaborative')->url("{$commandeId}/{$fileName}"),
                    'size' => $file->getSize(),
                    'path' => $path
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du téléchargement: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function listDocuments($commandeId)
    {
        try {
            $documents = [];
            $directory = "public/collaborative-docs/{$commandeId}";
            
            if (Storage::exists($directory)) {
                $files = Storage::files($directory);
                
                foreach ($files as $file) {
                    // Ignorer les fichiers cachés
                    if (strpos(basename($file), '.') === 0) {
                        continue;
                    }
                    
                    $documents[] = [
                        'name' => basename($file),
                        'url' => Storage::url($file),
                        'size' => Storage::size($file),
                        'modified' => Storage::lastModified($file),
                        'full_path' => $file
                    ];
                }
            }
            
            return response()->json([
                'success' => true,
                'documents' => $documents
            ], 200, [
                'Content-Type' => 'application/json; charset=utf-8'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage(),
                'documents' => []
            ], 500, [
                'Content-Type' => 'application/json; charset=utf-8'
            ]);
        }
    }
    
 public function getEditUrl($commandeId, $documentName)
    {
        try {
            $documentName = urldecode($documentName);
            // CHEMIN CORRECT
            $filePath = storage_path("app/public/collaborative-docs/{$commandeId}/{$documentName}");
            
            if (!file_exists($filePath)) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Document non trouvé à: ' . $filePath
                ], 404);
            }
            
            $documentUrl = url("/storage/collaborative-docs/{$commandeId}/{$documentName}");
            $editUrl = "https://view.officeapps.live.com/op/embed.aspx?src=" . urlencode($documentUrl);
            
            return response()->json([
                'success' => true,
                'editUrl' => $editUrl,
                'directUrl' => $documentUrl
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function deleteDocument($commandeId, $documentName)
    {
        try {
            $path = "public/collaborative-docs/{$commandeId}/" . urldecode($documentName);
            
            if (Storage::exists($path)) {
                Storage::delete($path);
                return response()->json([
                    'success' => true, 
                    'message' => 'Document supprimé avec succès'
                ], 200, [
                    'Content-Type' => 'application/json; charset=utf-8'
                ]);
            }
            
            return response()->json([
                'success' => false, 
                'message' => 'Document non trouvé'
            ], 404, [
                'Content-Type' => 'application/json; charset=utf-8'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression: ' . $e->getMessage()
            ], 500, [
                'Content-Type' => 'application/json; charset=utf-8'
            ]);
        }
    }

    // Charger le contenu d'un .docx en HTML pour édition Quill
    public function loadDocxAsHtml($commandeId, $documentName)
    {
        try {
            $name = urldecode($documentName);
            $relative = "public/collaborative-docs/{$commandeId}/{$name}";
            // 1) Si une version HTML sidecar existe (post-sauvegarde), la renvoyer directement
            $base = pathinfo($name, PATHINFO_FILENAME);
            $sidecar = "public/collaborative-docs/{$commandeId}/{$base}.quill.html";
            if (Storage::exists($sidecar)) {
                $html = Storage::get($sidecar);
                // Normaliser encodage et corriger la "mojibake"
                $html = $this->normalizeUtf8($html);
                return response()->json(['success' => true, 'html' => $html], 200, ['Content-Type' => 'application/json; charset=utf-8']);
            }
            if (!Storage::exists($relative)) {
                return response()->json(['success' => false, 'message' => 'Fichier introuvable'], 404);
            }
            $fullPath = Storage::path($relative);
            $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
            if (!in_array($ext, ['docx', 'doc'])) {
                return response()->json(['success' => false, 'message' => 'Type non supporté'], 422);
            }

            $phpWord = IOFactory::load($fullPath);
            // Exporter en HTML temporaire en mémoire
            $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
            ob_start();
            $htmlWriter->save('php://output');
            $html = ob_get_clean();

            // Normaliser strictement en UTF-8 pour éviter la "mojibake"
            if (function_exists('mb_check_encoding') && !mb_check_encoding($html, 'UTF-8')) {
                // Le HTML n'est pas UTF-8 valide → tenter depuis Windows-1252 (ou ISO-8859-1)
                $html = mb_convert_encoding($html, 'UTF-8', 'Windows-1252');
            }
            // Harmoniser la meta charset → UTF-8
            $html = preg_replace('/<meta[^>]*charset=["\']?([^"\'>\s]+)["\']?[^>]*>/i', '<meta charset="UTF-8">', $html) ?: $html;
            if (stripos($html, '<meta charset=') === false) {
                $html = preg_replace('/<head(\s*)>/i', '<head$1><meta charset="UTF-8">', $html, 1) ?: $html;
            }

            $html = $this->normalizeUtf8($html);
            return response()->json(['success' => true, 'html' => $html], 200, ['Content-Type' => 'application/json; charset=utf-8']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Sauvegarder du HTML venant de Quill vers .docx basique
    public function saveHtmlToDocx(Request $request, $commandeId, $documentName)
    {
        try {
            $validated = $request->validate([
                'html' => 'required|string'
            ]);
            $name = urldecode($documentName);
            $relative = "public/collaborative-docs/{$commandeId}/{$name}";
            if (!Storage::exists($relative)) {
                return response()->json(['success' => false, 'message' => 'Fichier introuvable'], 404);
            }
            $fullPath = Storage::path($relative);
            $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
            if ($ext !== 'docx') {
                // Normaliser en .docx
                $fullPath .= '.docx';
            }

            // Normaliser et assainir le HTML Quill
            $rawHtml = $validated['html'];
            $cleanHtml = $this->sanitizeHtmlForPhpWord($rawHtml);

            $phpWord = new PhpWord();
            $section = $phpWord->addSection();
            // Forcer en texte simple pour éliminer définitivement l'erreur XML
            $plain = html_entity_decode(strip_tags($cleanHtml), ENT_QUOTES, 'UTF-8');
            foreach (preg_split('/\r?\n/', $plain) as $line) {
                if (trim($line) === '') { $section->addTextBreak(); continue; }
                $section->addText($line);
            }
            $writer = IOFactory::createWriter($phpWord, 'Word2007');
            // S'assurer d'écrire en UTF-8
            if (method_exists($writer, 'setUseDiskCaching')) {
                $writer->setUseDiskCaching(true);
            }
            $writer->save($fullPath);

            // Écrire aussi un sidecar HTML pour réouverture rapide et fiable
            $base = pathinfo($name, PATHINFO_FILENAME);
            $sidecar = "public/collaborative-docs/{$commandeId}/{$base}.quill.html";
            // Normaliser avant stockage
            Storage::put($sidecar, $this->normalizeUtf8($cleanHtml));

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Assainit le HTML produit par Quill afin d'être compatible avec PhpWord Html::addHtml
     */
    private function sanitizeHtmlForPhpWord(string $html): string
    {
        // Normaliser les balises auto-fermantes
        $html = str_ireplace('<br>', '<br/>', $html);
        $html = str_ireplace('<hr>', '<hr/>', $html);

        // Échapper les & non entités (&amp; déjà valides ou &#...;)
        $html = preg_replace('/&(?!#?\w+;)/', '&amp;', $html);

        // Supprimer les balises potentiellement problématiques
        $html = preg_replace('#<(script|style|meta|link)[^>]*>.*?</\1>#is', '', $html);
        $html = preg_replace('#<(script|style|meta|link)[^>]*/?>#is', '', $html);

        // Encapsuler et re-serialiser via DOMDocument pour équilibrer
        try {
            libxml_use_internal_errors(true);
            $dom = new \DOMDocument('1.0', 'UTF-8');
            $wrapped = '<!DOCTYPE html><html><body>' . $html . '</body></html>';
            $dom->loadHTML($wrapped, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING);
            $bodies = $dom->getElementsByTagName('body');
            $result = '';
            if ($bodies->length > 0) {
                $body = $bodies->item(0);
                foreach (iterator_to_array($body->childNodes) as $child) {
                    $result .= $dom->saveHTML($child);
                }
            }
            libxml_clear_errors();
            $html = $result ?: $html;
        } catch (\Throwable $e) {
            // En cas d'échec, fallback minimal
            $html = nl2br(e(strip_tags($html)));
        }

        return $html;
    }

    /**
     * Corrige les encodages Windows-1252/ISO en UTF-8 et remplace les séquences mojibake fréquentes.
     */
    private function normalizeUtf8(string $text): string
    {
        // Si non UTF-8 valide, tenter conversion depuis Windows-1252
        if (function_exists('mb_check_encoding') && !mb_check_encoding($text, 'UTF-8')) {
            $text = mb_convert_encoding($text, 'UTF-8', 'Windows-1252');
        }
        // Remplacements ciblés pour séquences courantes
        $replacements = [
            'â' => '’',
            'â€™' => '’',
            'Â' => '',
            'lÃ¢ÂÂ' => 'l\'’',
            'Ã¢ÂÂ' => '’',
            'Ã¢ÂÂ' => '–',
            'Ã¢ÂÂ”' => '—',
            'Ã¢ÂÂ' => '“',
            'Ã¢ÂÂ' => '”',
            'Ã¢ÂÂ¢' => '•',
            'Ã¢ÂÂ¬' => '€',
            'ÃÂ©' => 'é',
            'Ã©' => 'é',
            'ÃÂ¨' => 'è',
            'Ã¨' => 'è',
            'ÃÂª' => 'ê',
            'Ãª' => 'ê',
            'ÃÂ«' => 'ë',
            'Ã«' => 'ë',
            'ÃÂ ' => 'à',
            'Ã ' => 'à',
            'ÃÂ¢' => 'â',
            'Ã¢' => 'â',
            'ÃÂ¹' => 'ù',
            'Ã¹' => 'ù',
            'ÃÂ»' => 'û',
            'Ã»' => 'û',
            'ÃÂ®' => 'î',
            'Ã®' => 'î',
            'ÃÂ´' => 'ô',
            'Ã´' => 'ô',
            'ÃÂ§' => 'ç',
            'Ã§' => 'ç',
            // Capitales accentuées fréquentes
            'ÃÂ' => 'É',
            'Ã' => 'É',
            'Ã‰' => 'É',
            'ÃÂ' => 'È',
            'Ã' => 'È',
            'Ãˆ' => 'È',
            'ÃÂ' => 'Ê',
            'Ã' => 'Ê',
            'ÃŠ' => 'Ê',
            'ÃÂ«' => 'Ë',
            'Ã' => 'Ë',
            'Ã‹' => 'Ë',
            // Guillemets/apostrophes typographiques cassés
            'â' => '’',
            'â€œ' => '“',
            'â€' => '”',
        ];
        $text = strtr($text, $replacements);
        // Uniformiser les apostrophes en simple quote pour éviter les mélanges l'’équipe
        $text = str_replace(['’', '‘'], "'", $text);
        return $text;
    }




    
}
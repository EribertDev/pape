<?php

use App\Models\Payement;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\client\FaqController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\client\BiblioController;
use App\Http\Controllers\client\ContactController;
use App\Http\Controllers\client\PayementController;
use App\Http\Controllers\client\BaseDonneController;
use App\Http\Controllers\client\ClientDashController;
use App\Http\Controllers\client\LandingPageController;
use App\Http\Controllers\client\ThemeMemoireController;
use App\Http\Controllers\client\ClientProfileController;
use App\Http\Controllers\client\services\ServiceController;
use App\Http\Controllers\client\services\CommandeController;
use App\Models\Affiler;
use Illuminate\Http\Request; // Ajouter cette importation
use App\Http\Controllers\client\ReprographyOrderController;
use App\Http\Controllers\client\services\RedactionController;
use App\Models\ThemeMemoire;
use App\Http\Controllers\StageController;
use App\Models\Stage;
use App\Http\Controllers\Admin\DemandeStageController;
use App\Mail\FormationRequestMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\client\ProjectRequestController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\client\MessageController;
use App\Http\Controllers\VideoCallController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
|
*/






Route::get('email/verify/sent', function () {
    return view('clients.layouts.email-verify.email-verify-sent');; // Créez cette vue pour informer l'utilisateur
})->name('email.verify.sent');

Route::get('/', LandingPageController::class)->name('home');
/**===============================
 * client
=================================*/

Route::get('/search/themes', [BiblioController::class, 'search'])->name('themes.search');


/**
 * Route service offre
 */
// Formulaire pré-rempli selon le type
Route::get('/services/redaction/form/{type}', [ServiceController::class, 'showForm'])
     ->name('redaction.form')
     ->where('type', 'vip|standard');

Route::get('/services/redaction', [ServiceController::class, 'showOffers'])
     ->name('redaction.offers');
Route::get('/service-offre',ServiceController::class)->name('service.offre');
Route::get('/service-offre/redaction/{type}',\App\Http\Controllers\client\services\RedactionController::class)->name('service.redaction')
->where('type', 'vip|standard');
Route::get('/service-offre/tarif',function (){
    return view('clients.layouts.services.tarifs');
})->name('service.tarif');

//route de favoris 
Route::get('/favorites', [BiblioController::class, 'getFavorites'])->name('favorites.get');




//route de stockage temporaire de media
Route::post('files/store/temp',[FileController::class,'storeFileTemp'])->name('files.store.temp');
Route::post('files/delete/temp',[FileController::class,'deleteFileTemp'])->name('files.delete.temp');

//route de bibliothèque de theme de memoire
Route::get('/biblio',[BiblioController::class,'index'])->name('biblios');
Route::get('/themes', function () {
    return response()->json(ThemeMemoire::all());
});

Route::get('/search-themes',[BiblioController::class,'searchThemes'])->name('themes.search');
//route de base de données
Route::get('/bd-all',[BaseDonneController::class,'index'])->name('bds.all');
Route::get('/bd/detail/{uuid}/{fakeUuid}',[BaseDonneController::class,'getBdDetail'])->name('bd.detail');

//route payement Base de données
Route::post('/pay/bd',[BaseDonneController::class,'newPayement'])->name('pay.bd');
Route::post('/pay/bd/verify',[BaseDonneController::class,'verifyPayement'])->name('paybd.verify');
Route::post('/pay/bd/confirme',[PayementController::class,'confirmePayement'])->name('paybd.confirme');
Route::post('/pay/bd/finish',[BaseDonneController::class,'finishPayement'])->name('paybd.finish');
Route::post('/download/bd/file', [BaseDonneController::class,'downloadFinalFile'])->name('download.bd.file');
Route::get('/filter-bds', [BaseDonneController::class, 'filterBds'])->name('bds.filter');







//route theme mémoire
Route::get('/theme-memoire-all',[ThemeMemoireController::class,'index'])->name('tm.all');
//Route::get('/theme-memoire/categories/{id}/{fakeUuid}/{fakeUuid}',[ThemeMemoireController::class,'getBdDetail'])->name('bd.detail');

//route FAQ's
Route::get('/faqs',FaqController::class)->name('faqs');
//
Route::get('/a-propos',function (){
    return view('clients.layouts.faqs.a-propos');
})->name('a-propos');

/*Route::get('/reset-password',function (){
    return view('clients.layouts.reset-password.reset-password');
})->name('reset.password');*/

//route Contact
Route::get('contact',[ContactController::class,'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::middleware(['auth','role:Client'])->group(function (){

    //
    Route::get('/mon-espace',[ClientDashController::class,'index'])->name('dash.client');
    Route::get('/mon-espace/commande',[ClientDashController::class,'commandes'])->name('dash.commande');
    Route::get('/mon-espace/commande/detail/{uuid}',[ClientDashController::class,'commandeDetaile'])->name('dash.client.commande.detail');

    //route commande clients
    Route::post('/service-offre/commande/verify',[CommandeController::class,'newCommande'])->name('commande.verify');
    Route::post('/service-offre/commande/finalization',[CommandeController::class,'finalization']);
    Route::get('/service-offre/commandeFinish/{idCmd}',[CommandeController::class,'commandeFinish'])->name("commande.finish");
    Route::get('/service-offre/commandeStatus',[CommandeController::class,'commandeStatus'])->name("commande.status");
    Route::post('/download/commmande/finale/file', [CommandeController::class,'downloadFinalFile'])->name('download.commmande.finale.file');
    Route::get('/download/file/cmd/{id}',[CommandeController::class,'downloadfile'])->name('download.file');
    Route::get('/view/file/cmd/{id}',[CommandeController::class,'viewFile'])->name('view.file');
    Route::post('/add/file/cmd/',[CommandeController::class,'addFile'])->name('commandes.uploadFiles');


    //route commande pay
    Route::post('/pay/commande',[PayementController::class,'newPayCommande'])->name('pay.commande');
    Route::post('/pay/commande/verify',[PayementController::class,'verifyPayement'])->name('pay.verify');
    Route::post('/pay/commande/confirme',[PayementController::class,'confirmePayement'])->name('pay.confirme');
    Route::post('/pay/commande/finish',[PayementController::class,'finishPayement'])->name('pay.finish');
    Route::get('/pay/commande/reclamation',[PayementController::class,'reclamation'])->name('pay.reclamation');
    Route::post('/pay/commande/reclamation/post',[PayementController::class,'reclamation'])->name('pay.reclamation.post');

    //
    Route::get('/email/verify/sucess',function(){return view('clients.layouts.email-verify.email-verify-sucess');})->name('email.verify.sucess');
    Route::get('/email/verify/error',function(){return view('clients.layouts.email-verify.email-verify-error');})->name('email.verify.error');
    //route profile clients
    Route::get('/client-profil',[ClientProfileController::class,'index'])->name('client.profile');
    Route::post('/client-profile/edit',[ClientProfileController::class,'profileUpdate'])->name('profile.edit');
    //
    Route::get('/download/{file}', function ($file) {return Storage::download('files/' . $file);})->name('file.download');
});


//Route Demande de Stage 

Route::get('/stage',[StageController::class,'index'])->name('stage');
Route::get('/stage/dash', [StageController::class, 'dashClient'])->name('internships.dash');

Route::get('/stage/finish', function () {
    return view('clients.layouts.services.demande-finish');
})->name('stage.finish');
Route::get('/download/contract/{id}', [StageController::class, 'download'])->name('internship.download');
Route::post('/upload-signed', [StageController::class, 'uploadSigned'])->name('internship.upload-signed');
Route::get('/download/authorization/{id}', [DemandeStageController::class, 'downloadAuthorization'])->name('authorization.uploaded');


// 
Route::post('/stage/store', [StageController::class, 'store'])->name('stage.store');
Route::post('/generate-contract', [StageController::class, 'generateContract'])->name('generate.contract');
Route::post('/upload-signed', [StageController::class, 'uploadSignedContract'])->name('internship.upload-signed');
Route::get('/internships/uploaded/{id}/uploaded', [DemandeStageController::class, 'downloadSignedContract'])
    ->name('internship.uploaded'); 

Route::get('/internship-request/{id}/download-letter', [StageController::class, 'downloadLetter'])
    ->name('internship.download-letter');


// Admin
Route::get('/admin/internships', [AdminController::class, 'index'])->name('admin.internships');
Route::get('/download-signed/{request}', [AdminController::class, 'downloadSignedContract'])->name('download.signed');
Route::patch('/update-status/{request}', [AdminController::class, 'updateStatus'])->name('update.status');



// Demande de Formation 
Route::post('/send-formation-request', function (Request $request) {
    $validated = $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'nullable|email',
        'phone' => 'required|string|max:20',
        'formationType' => 'required|string',
        'formationTheme' => 'required|string|max:255',
        'participants' => 'required|integer|min:1',
        'duration' => 'required|integer|min:1',
        'datePreference' => 'nullable|string',
        'objectives' => 'required|string',
        'additionalInfo' => 'nullable|string',
    ]);
    
    // Envoyer directement l'email
    Mail::to('serviceclient@cesiebenin.com')->send(new FormationRequestMail($validated));
    
    return response()->json(['success' => true]);
})->name('formation.send');



//Route demande d'assistance Projet  
Route::middleware(['auth'])->group(function () {
    Route::get('/project-request/create', [ProjectRequestController::class, 'create'])->name('project_request.create');
    Route::post('/project-request', [ProjectRequestController::class, 'store'])->name('project_request.store');
    Route::get('/project-request/confirmation/{projectRequest}', [ProjectRequestController::class, 'confirmation'])->name('project_request.confirmation');
    Route::get('/project-request/payment/', [ProjectRequestController::class, 'show'])->name('projects.payment');
    Route::get('/project-request/show/{projectRequest}', [ProjectRequestController::class, 'show'])->name('projects.show');
    Route::get('/project/dash', [ProjectRequestController::class, 'dashClient'])->name('projects.dash');
    Route::get('client/projects/download/{id}', [AdminProjectController::class, 'download'])->name('document.download');

});

//Route Paiement Project
Route::post('/pay/project',[ProjectRequestController::class,'newPayement'])->name('pay.project');
Route::post('/pay/project/verify',[ProjectRequestController::class,'verifyPayement'])->name('pay.project.verify');
Route::post('/pay/project/confirme',[ProjectRequestController::class,'confirmePayement'])->name('pay.project.confirme');
Route::post('/pay/project/finish',[ProjectRequestController::class,'finishPayement'])->name('pay.project.finish');



//Route Message 
Route::middleware(['auth'])->group(function () {

    Route::get('/message/client', [MessageController::class, 'index'])->name('message.client');

});


//Route Reprograpy
Route::get('/reprography/commander', [ReprographyOrderController::class, 'create'])->name('reprography.client');
Route::post('/reprography/store', [ReprographyOrderController::class, 'store'])->name('reprography.store');


//ROUTE VISIONFERENCE
Route::middleware(['auth'])->group(function () {
    // Routes pour les visioconférences Jitsi
    Route::post('/commandes/{commande}/video-calls', [VideoCallController::class, 'create'])
        ->name('video-calls.create');
    
    Route::get('/video-calls/{videoCall}/join', [VideoCallController::class, 'join'])
        ->name('video-call.join');
    
    Route::post('/video-calls/{videoCall}/end', [VideoCallController::class, 'end'])
        ->name('video-call.end');
    
    Route::get('/commandes/{commande}/video-calls', [VideoCallController::class, 'listByCommande'])
        ->name('video-calls.list');
    Route::post('/video-calls/{videoCall}/leave', [VideoCallController::class, 'leave'])
    ->name('video-call.leave');
});


Route::middleware(['auth'])->group(function () {
    // Routes pour les visioconférences
    Route::post('/commandes/{commande}/video-calls', [VideoCallController::class, 'create'])
        ->name('video-calls.create');
    
    Route::get('/video-calls/{videoCall}/join', [VideoCallController::class, 'join'])
        ->name('video-call.join');

     Route::post('/video-calls/{videoCall}/end', [VideoCallController::class, 'end'])
        ->name('video-call.end');
    
    Route::get('/list/{commande}/video-calls', [VideoCallController::class, 'listByCommande'])
        ->name('video-calls.list');
    
    
});

/*
|--------------------------------------------------------------------------
|Route Admin
|--------------------------------------------------------------------------
*/
require __DIR__.'/admin.php';
/*
|--------------------------------------------------------------------------
|Route auth
|--------------------------------------------------------------------------
*/

Route::post('/register/client',[AuthController::class,'registerClient'])->name('register');




Route::middleware('guest')->group(function () {
    // Afficher le formulaire pour demander un lien de réinitialisation
    Route::get('forgot-password', [PasswordController::class, 'create'])
        ->name('password.request');

    // Envoyer le lien de réinitialisation
    Route::post('forgot-password', [PasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    // Afficher le formulaire de réinitialisation de mot de passe
    Route::get('reset-password/{token}', [PasswordController::class, 'edit'])
        ->name('password.reset');

    // Réinitialiser le mot de passe
    Route::post('reset-password', [PasswordController::class, 'reset']) // Utilisez 'reset-password' au lieu de 'update-password'
        ->name('password.update');
});


require __DIR__.'/auth.php';

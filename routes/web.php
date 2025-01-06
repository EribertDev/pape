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
use GuzzleHttp\Psr7\Request;

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
Route::get('/service-offre',ServiceController::class)->name('service.offre');
Route::get('/service-offre/redaction',\App\Http\Controllers\client\services\RedactionController::class)->name('service.redaction');
Route::get('/service-offre/tarif',function (){
    return view('clients.layouts.services.tarifs');
})->name('service.tarif');



//route de stockage temporaire de media
Route::post('files/store/temp',[FileController::class,'storeFileTemp'])->name('files.store.temp');
Route::post('files/delete/temp',[FileController::class,'deleteFileTemp'])->name('files.delete.temp');

//route de bibliothèque de theme de memoire
Route::get('/biblio',[BiblioController::class,'index'])->name('biblios');

//route de base de données
Route::get('/bd-all',[BaseDonneController::class,'index'])->name('bds.all');
Route::get('/bd/detail/{uuid}/{fakeUuid}',[BaseDonneController::class,'getBdDetail'])->name('bd.detail');

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
    Route::get('/mon-espace/commande/detail/{uuid}',[ClientDashController::class,'commandeDetaile'])->name('dash.client.commande.detail');

    //route commande clients
    Route::post('/service-offre/commande/verify',[CommandeController::class,'newCommande'])->name('commande.verify');
    Route::post('/service-offre/commande/finalization',[CommandeController::class,'finalization']);
    Route::get('/service-offre/commandeFinish/{idCmd}',[CommandeController::class,'commandeFinish'])->name("commande.finish");
    Route::get('/service-offre/commandeStatus',[CommandeController::class,'commandeStatus'])->name("commande.status");
    Route::post('/download/commmande/finale/file', [CommandeController::class,'downloadFinalFile'])->name('download.commmande.finale.file');

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

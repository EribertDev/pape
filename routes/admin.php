<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\PayementController;
use App\Http\Controllers\Admin\BaseDonneController;
use App\Http\Controllers\Admin\ThemeMemoireController;

Route::middleware(['auth','role:Administrateur'])->group(function () {
    //
    Route::get('/admin/dash', DashController::class)->name('admin.dash');
    //
    Route::get('/admin/commande', [CommandeController::class, 'index'])->name('admin.commande');
    Route::get('/admin/commande/all/processing', [CommandeController::class, 'getProcessingCommande'])->name('admin.commande.all');
    Route::get('/admin/commande/all/new', [CommandeController::class, 'allNewCommande'])->name('admin.commande.new');
    Route::get('/admin/commande/get/{uuid}', [CommandeController::class, 'getCommande'])->name('admin.commande.get');
    Route::post('/admin/commande/add/redactor', [CommandeController::class, 'addRedactor'])->name('admin.commande.add.redactor');
    Route::post('/admin/commande/reject', [CommandeController::class, 'rejectCommande'])->name('admin.commande.reject');
    Route::post('/admin/commande/approved', [CommandeController::class, 'approvedCommande'])->name('admin.commande.approved');
    Route::post('/admin/commande/fileUpdate', [CommandeController::class, 'fileUpdate'])->name('admin.commande.fileUpdate');
    //
    Route::get('/admin/payements', [PayementController::class, 'index'])->name('admin.payements');
    Route::get('/admin/payements/all', [PayementController::class, 'getAllPayement'])->name('admin.payements.all');
    //
    Route::get('/admin/staff', [StaffController::class, 'index'])->name('admin.staff');
    Route::post('/admin/staff/add/member', [StaffController::class, 'addMember'])->name('admin.staff.add.member');
    Route::post('/admin/staff/detail/member', [StaffController::class, 'getMembre'])->name('admin.staff.detail.member');
    Route::post('/admin/staff/locked/member', [StaffController::class, 'lockedMember'])->name('admin.staff.locked.member');
    Route::post('/admin/staff/delete/member', [StaffController::class, 'deleteMembre'])->name('admin.staff.detail.member');
    //
    Route::get('/admin/base-donne', [BaseDonneController::class, 'index'])->name('admin.base-donne');
    Route::get('/admin/base-donne/all', [BaseDonneController::class, 'getAllBd'])->name('admin.base-donne.all');
    Route::post('/admin/base-donne/get', [BaseDonneController::class, 'getBd'])->name('admin.base-donne.get');
    Route::post('/admin/base-donne/edit', [BaseDonneController::class, 'editBd'])->name('admin.base-donne.edit');
    Route::post('/admin/base-donne/add/new', [BaseDonneController::class, 'addNew'])->name('admin.base-donne.addNew');
    Route::post('/admin/base-donne/delete', [BaseDonneController::class, 'delete'])->name('admin.base-donne.delete');
    Route::post('/admin/base-donne/download', [BaseDonneController::class, 'download'])->name('admin.base-donne.download');
    //
    Route::get('/admin/theme-memoire', [ThemeMemoireController::class, 'index'])->name('admin.theme-memoire');
    Route::get('/admin/theme-memoire/all', [ThemeMemoireController::class, 'getAll'])->name('admin.theme-memoire.all');
    Route::post('/admin/theme-memoire/get', [ThemeMemoireController::class, 'getTM'])->name('admin.theme-memoire.get');
    Route::post('/admin/theme-memoire/add/new', [ThemeMemoireController::class, 'addNewTM'])->name('admin.theme-memoire.addNew');
    Route::post('/admin/theme-memoire/edit', [ThemeMemoireController::class, 'editTM'])->name('admin.theme-memoire.edit');
    Route::post('/admin/theme-memoire/delete', [ThemeMemoireController::class, 'delete'])->name('admin.theme-memoire.delete');
    Route::post('/admin/theme-memoire/download', [ThemeMemoireController::class, 'download'])->name('admin.theme-memoire.download');
    //
});

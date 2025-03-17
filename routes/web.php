<?php

use Illuminate\Support\Facades\Route;

//appel des controllers qui sont dan app/http/controllers/*
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChevalController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\PalmaresController;
use App\Http\Controllers\SoinVetController;
use App\Http\Controllers\SoinEntrainController;
use App\Http\Controllers\CavalierController;

use Illuminate\Support\Facades\Auth;

//routes accessibles pour tout le monde
//routes login et logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); })->name('logout');

//routes page accueil et liens pour voir les chevaux, palmares et competitions
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/chevaux', [ChevalController::class, 'index'])->name('chevaux.index');
Route::get('/competitions', [CompetitionController::class, 'index'])->name('competitions.index');
Route::get('/palmares', [PalmaresController::class, 'index'])->name('palmares.index');

//routes poues les informations sur les compétitions
Route::get('/competitions/cavaliers', [CompetitionController::class, 'cavaliersActifs'])->name('competitions.cavaliers');
Route::get('/competitions/moyenne', [CompetitionController::class, 'moyenneCompetParCheval'])->name('competitions.moyenne');
Route::get('/competitions/victoires', [CompetitionController::class, 'villesVictoires'])->name('competitions.victoires');
Route::get('/competitions/chevaux', [ChevalController::class, 'chevauxParRaceEtCompet'])->name('chevaux.compet');

//route pour consulter le palmarès d’un cheval
Route::get('/palmares/{id_cheval}', [PalmaresController::class, 'showPalmares'])->name('palmares.show');

//routes accessibles seulement si on est authentifié
Route::middleware(['auth'])->group(function () {

    //SOIN VETERINAIRE POUR UN VETERINAIRE
    //routes pour les soins vétérinaires
    Route::middleware('auth')->group(function () {
        Route::get('/soins', [SoinVetController::class, 'index'])->name('soins.index');
        Route::get('/soins/30jours', [SoinVetController::class, 'soins30j'])->name('soins.30j');
    });

    //gerer  les soins -- ajouts + modif ou supp un soin
    Route::get('/soins/gerer', [SoinVetController::class, 'gerer'])->name('soins.gerer');
    Route::post('/soins/gerer', [SoinVetController::class, 'ajouter'])->name('soins.ajouter');
    Route::get('/soins/modifier/{id_soin}', [SoinVetController::class, 'modifier'])->name('soins.modifier');
    Route::put('/soins/modifier/{id_soin}', [SoinVetController::class, 'mettreAJour'])->name('soins.mettreAJour');
    Route::delete('/soins/supprimer/{id_soin}', [SoinVetController::class, 'supprimer'])->name('soins.supprimer');


    //SOIN ENTRAINEUR
    //routes pour les soins des chevaux sous les 30jours quand on est un entraineur
    Route::get('/soins-entraineur', [SoinEntrainController::class, 'index'])->name('soins.entraineur');

    //CAVALIERS info
    //routes pour les avoir les informations d'un cavalier ainsi que les autres cavaliers(collègues :))
    Route::get('/cavalier/info', [CavalierController::class, 'infoCaval'])->name('cavaliers.info');
    Route::get('/cavaliers/collegues', [CavalierController::class, 'infoCollegues'])->name('cavalier.collegues');


    // test roles check si role est bon OK 
    Route::get('/test-role', function () {
        return Auth::user()->role;
    })->middleware('auth');


});

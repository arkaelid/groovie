<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    HomeController,
    LoginController,
    LogoutController,
    RegisterController,
    FestivalController,
    GroovieController,
    AdminController,
    ProfilController,
    VoyagesController,
    HeaderController,
    TrajetController,
    ExperienceController
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/experience', [ExperienceController::class, 'index'])->name('experience');





// Route permettant l'authentification de l'utilisateur
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Route permettant l'affichage de la page d'accueil
Route::get('/', [FestivalController::class, 'index'])->name('home');

// Route permettant l'affichage de la page d'un festival
Route::get('/festivals/{festival:slug}', [FestivalController::class, 'show'])->name('festival.show');

// Route permettant d'afficher la recherche de festivals
Route::get('/search', [FestivalController::class, 'search']);

// Route permettant d'afficher les festivals selon un filtre
Route::get('/filter', [FestivalController::class, 'filter']);

// Route permettant d'ajouter un billet par rapport à un festival
Route::post('/festivals/{festival}/tickets', [FestivalController::class, 'addBillet'])->name('festival.billet.add');

Route::post('/festivals/tickets', [FestivalController::class, 'addBilletwithoutFestival'])->name('festival.billet.add.two');

// Routes reliées au menu groovie
Route::middleware(['client'])->group(
    function () {
        Route::get('/trajet', [VoyagesController::class, 'index'])->name('trajet');
        Route::get('/groovie', [GroovieController::class, 'index'])->name('groovie');
        Route::post('/update-avatar', [GroovieController::class, 'updateAvatar'])->name('update.avatar');
        Route::post('/groovie/profil/update', [GroovieController::class, 'updateProfile'])->name('groovie.profil.update');
        Route::post('/groovie/profil/close', [GroovieController::class, 'closeAccount'])->name('groovie.profil.close');
        Route::get('/offres/{id}', [GroovieController::class, 'showOfferDetail'])->name('offres.detail');
        Route::post('/offres/utiliser/{id}', [GroovieController::class, 'useOffer'])->name('offre.utiliser');
        Route::get('/trajet/search', [VoyagesController::class, 'trajetsUtilisateur'])->name('trajet.utilisateur');
        Route::get('/trajet/{trajet}', [TrajetController::class, 'details'])->name('trajet.details');
        Route::post('/trajet/reservation/{trajet}', [TrajetController::class, 'reserverTrajet'])->name('trajet.reservation');
        Route::post('/trajet/enregistrer/{trajet}', [TrajetController::class, 'enregistrerTrajet'])->name('trajet.enregistrer');

    }
);

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/submit', [AdminController::class, 'submit'])->name('login.submit');

Route::middleware(['admin'])->group(
    function(){
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/admin/users', [AdminController::class, 'usersCatalog'])->name('admin.users');
        Route::post('/admin/{user}/supprimer', [AdminController::class, 'userDelete'])->name('admin.user.delete');
        Route::post('/admin/{user}/suspendre', [AdminController::class, 'userSuspendre'])->name('admin.user.suspendre');
        Route::post('/admin/{user}/disponible', [AdminController::class, 'userDisponible'])->name('admin.user.disponible');
        Route::get('/admin/{user}/profil',[AdminController::class, 'userProfil'])->name('admin.user.profil');
        Route::put('/admin/{user}/update', [AdminController::class, 'updateProfil'])->name('admin.user.update');
        Route::get('/admin/offres', [AdminController::class, 'showOffres'])->name('admin.show.offres');
        Route::get('/admin/festivals', [AdminController::class, 'fetivalCatalog'])->name('admin.festivals');
        Route::get('admin/{festival}/fiche', [AdminController::class, 'showFestival'])->name('admin.festival.show');
        Route::put('/admin/{festival}/edit', [AdminController::class, 'editFestival'])->name('admin.festival.edit');
        Route::delete('/admin/{festival}/delete', [AdminController::class, 'deleteFestival'])->name('admin.festival.delete');
        Route::get('admin/actualites', [AdminController::class, 'actualiteCatalog'])->name('admin.actualites');
        Route::get('admin/{actualite}/show', [AdminController::class, 'actualiteShow'])->name('admin.actualite.show');
        Route::put('/admin/{actualite}/modification', [AdminController::class, 'actualiteUpdate'])->name('admin.actualite.update');
        Route::delete('/admin/{actualite}/suppression', [AdminController::class, 'actualiteDelete'])->name('admin.actualite.delete');
        Route::get('admin/actualite/ajout', [AdminController::class, 'actualiteAjout'])->name('admin.actualite.ajout');
        Route::post('admin/actualite/create', [AdminController::class, 'actualiteCreate'])->name('admin.actualite.create');
    }
);

Route::get('/notifications/count', [HeaderController::class, 'getNotificationsCount'])->name('notifications.count');



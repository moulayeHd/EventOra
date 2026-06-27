<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BilletController;
use App\Http\Controllers\DemandeOrganisateurController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrganisateurController;
use App\Http\Controllers\ReservationController;
use App\Models\Evenement;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

// ─── Pages publiques ───────────────────────────────────────
Route::get('/', function () {
    $events = Schema::hasTable('evenements')
        ? Evenement::with('espace')->orderBy('date')->take(3)->get()
        : collect();

    return view('home', compact('events'));
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/events', [EventController::class, 'index'])->name('events');

Route::get('/event', function () {
    return redirect()->route('events');
})->name('event');

Route::get('/events/{event}', [EventController::class, 'show'])
    ->whereNumber('event')
    ->name('event.details');

Route::get('/event-details', function () {
    return redirect()->route('events');
})->name('event.details.default');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// ─── Authentification ──────────────────────────────────────
Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
Route::post('/connexion', [AuthController::class, 'login'])->name('login.store');
Route::get('/inscription', [AuthController::class, 'showRegister'])->name('inscription');
Route::post('/inscription', [AuthController::class, 'register'])->name('inscription.store');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/deconnexion', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ─── Vérification billet ───────────────────────────────────
Route::get('/billets/verify/{code}', [BilletController::class, 'verify'])
    ->name('billets.verify');

// ─── Page attente validation ───────────────────────────────
Route::get('/attente-validation', function () {
    return view('attente-validation');
})->middleware('auth')->name('attente.validation');

// ─── Demande organisateur ──────────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/devenir-organisateur', [DemandeOrganisateurController::class, 'create'])
        ->name('demande.organisateur.form');
    Route::post('/devenir-organisateur', [DemandeOrganisateurController::class, 'store'])
        ->name('demande.organisateur.store');
});

// ─── Espace organisateur ───────────────────────────────────
Route::middleware(['auth', 'role:organisateur,administrateur'])->group(function () {
    Route::get('/organisateur', [OrganisateurController::class, 'index'])->name('organisateur');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::patch('/events/{event}', [EventController::class, 'update']);
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});

// ─── Espace admin ──────────────────────────────────────────
Route::middleware(['auth', 'role:administrateur'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Gestion utilisateurs
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    // Gestion espaces
    Route::post('/admin/espaces', [AdminController::class, 'storeVenue'])->name('admin.espaces.store');
    Route::put('/admin/espaces/{espace}', [AdminController::class, 'updateVenue'])->name('admin.espaces.update');
    Route::delete('/admin/espaces/{espace}', [AdminController::class, 'destroyVenue'])->name('admin.espaces.destroy');

    // Gestion demandes organisateur
    Route::post('/admin/demandes/{demande}/approuver', [AdminController::class, 'approuverDemande'])
        ->name('admin.demandes.approuver');
    Route::post('/admin/demandes/{demande}/refuser', [AdminController::class, 'refuserDemande'])
        ->name('admin.demandes.refuser');
});

// ─── Réservations ──────────────────────────────────────────
Route::resource('reservations', ReservationController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware('auth');

// ─── Billets ───────────────────────────────────────────────
Route::get('/mes-billets', [BilletController::class, 'index'])
    ->middleware('auth')
    ->name('billets.index');

// ─── Notifications ─────────────────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');
    Route::post('/notifications/{notification}/lire', [NotificationController::class, 'marquerLu'])
        ->name('notifications.lire');
    Route::post('/notifications/tout-lire', [NotificationController::class, 'toutLire'])
        ->name('notifications.toutLire');
});
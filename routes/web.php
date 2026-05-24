<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BilletController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganisateurController;
use App\Http\Controllers\ReservationController;
use App\Models\Evenement;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

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

Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
Route::post('/connexion', [AuthController::class, 'login'])->name('login.store');
Route::get('/inscription', [AuthController::class, 'showRegister'])->name('inscription');
Route::post('/inscription', [AuthController::class, 'register'])->name('inscription.store');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/deconnexion', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/billets/verify/{code}', [BilletController::class, 'verify'])
    ->name('billets.verify');

Route::middleware(['auth', 'role:organisateur,administrateur'])->group(function () {
    Route::get('/organisateur', [OrganisateurController::class, 'index'])->name('organisateur');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::patch('/events/{event}', [EventController::class, 'update']);
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});

Route::middleware(['auth', 'role:administrateur'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::post('/admin/espaces', [AdminController::class, 'storeVenue'])->name('admin.espaces.store');
    Route::delete('/admin/espaces/{espace}', [AdminController::class, 'destroyVenue'])->name('admin.espaces.destroy');
});

Route::resource('reservations', ReservationController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware('auth');

Route::get('/mes-billets', [BilletController::class, 'index'])
    ->middleware('auth')
    ->name('billets.index');

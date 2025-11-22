<?php

use App\Http\Controllers\PersonController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('people.index');
});

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rota para criar usuário estático
Route::get('/create-user', [AuthController::class, 'createStaticUser']);

// Rotas PÚBLICAS de People
Route::get('/people', [PersonController::class, 'index'])->name('people.index');
Route::get('/people/{person}', [PersonController::class, 'show'])->name('people.show');

// Rotas PÚBLICAS de Contacts
Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');

Route::get('/stats/contacts-by-country', [StatsController::class, 'contactsByCountry'])->name('stats.contacts-by-country');

// ========== ROTAS PROTEGIDAS ==========
Route::middleware('auth')->group(function () {
    Route::get('/create', [PersonController::class, 'create'])->name('people.create');
    Route::post('/people', [PersonController::class, 'store'])->name('people.store');
    Route::get('/people/{person}/edit', [PersonController::class, 'edit'])->name('people.edit');
    Route::put('/people/{person}', [PersonController::class, 'update'])->name('people.update');
    Route::delete('/people/{person}', [PersonController::class, 'destroy'])->name('people.destroy');

    Route::get('/contacts/create/{person}', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});

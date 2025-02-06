<?php

use App\Http\Controllers\Auth\KeycloakController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyKeycloakAuth;

// Rota para a página principal
Route::get('/', function () {
    return "Você está na página principal";
})->name('index')->middleware(VerifyKeycloakAuth::class);

// Rota de onboard
Route::get('/onboard', function () {
    return view('pages.onboard');
})->name('onboard');
// Rotas de autenticação com Keycloak
Route::get('/login', [KeycloakController::class, 'redirectToKeycloak'])->name('login');
Route::get('/callback', [KeycloakController::class, 'handleKeycloakCallback'])->name('callback');
Route::post('/backchannel-logout', [KeycloakController::class, 'backchannelLogout'])->name('backchannel.logout');

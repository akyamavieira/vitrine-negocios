<?php

use App\Http\Controllers\Auth\KeycloakController;
use Illuminate\Support\Facades\Route;


Route::get('/onboard', function () {
    return view('pages.onboard');
})->name('onboard');
// Rotas de autenticação com Keycloak
Route::get('/login', [KeycloakController::class, 'redirectToKeycloak'])->name('login');
Route::get('/callback', [KeycloakController::class, 'handleKeycloakCallback'])->name('callback');
Route::post('/backchannel-logout', [KeycloakController::class, 'backchannelLogout'])->name('backchannel.logout');

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class VerifyKeycloakAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Se o usuário já está autenticado pelo Laravel, continuar normalmente
        if (Auth::check()) {
            return $next($request);
        }

        // Se a sessão 'user' existe, mas a autenticação não foi aplicada, tentar autenticá-lo
        if (Session::has('user')) {
            $user = Session::get('user');

            // Autenticar o usuário manualmente no Laravel (caso ainda não esteja autenticado)
            Auth::loginUsingId($user['id']); // Certifique-se de que 'id' existe e está correto

            return $next($request);
        }

        // Se nenhuma das verificações passou, redireciona para o login
        return redirect()->route('login');
    }
}
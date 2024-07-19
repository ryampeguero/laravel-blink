<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class CheckAuthToken
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if ($token) {
            // Trova il token e autentica l'utente
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken && $accessToken->tokenable) {
                // Autentica l'utente
                Auth::login($accessToken->tokenable);

                return $next($request);
            }
        }

        // Ritorna alla pagina di login se l'utente non è autenticato
        return redirect()->route('login');
    }
}

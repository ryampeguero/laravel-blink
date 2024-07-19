<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $registerUserData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
        ]);

        return response()->json([
            'message' => 'User Created',
        ]);
    }

    public function login(Request $request)
    {
        $loginUserData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $loginUserData['email'])->first();

        if (! $user || ! Hash::check($loginUserData['password'], $user->password)) {
            return response()->json([
                'error' => 'Invalid Credentials',
            ], 401);
        }

        // Creazione del token di accesso
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function authenticateWithToken(Request $request)
    {
        // Validazione della richiesta
        $request->validate([
            'email' => 'required|string|email',
            'token' => 'required|string',
        ]);

        // Recupera l'email e il token dalla richiesta
        $email = $request->input('email');
        $token = $request->input('token');

        // Trova l'utente corrispondente all'email fornita
        $user = User::where('email', $email)->first();

        if (! $user) {
            return response()->json([
                'error' => 'User not found',
            ], 404);
        }

        // Verifica se il token ricevuto corrisponde a quello generato per l'utente
        if (! hash_equals($user->token, hash('sha256', $token))) {
            return response()->json([
                'error' => 'Invalid token',
            ], 401);
        }

        Auth::login($user);

        return response()->json([
            'message' => 'User authenticated successfully',
            'user' => $user,
        ]);
    }

    public function refreshToken(Request $request)
    {
        $user = $request->user();

        // Se l'utente non è autenticato, ritorna un errore 401
        if (! $user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        // Rigenera il token di accesso per l'utente corrente
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        return response()->json(['access_token' => $token]);
    }
}

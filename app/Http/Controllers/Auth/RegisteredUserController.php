<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'min:8', Rules\Password::defaults()],
            'img_path' => ['nullable'],
        ], [
            'name.string' => 'Nome deve sessere una stringa di testo',
            'name.max' => 'Nome troppo lungo',
            'email.required' => 'Email è un campo obbligatorio',
            'email.string' => 'Email deve essere una stringa di testo',
            'password.required' => 'Password è un campo obbligatorio',
            'password.confirmed' => 'Password non corrispondono',
            'password.min' => 'Password deve contenere almeno :min caratteri'
        ]);

        if ($request->hasFile('img_path')) {
            $image_path = Storage::put('user_img', $request->file('img_path'));
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'img_path' => isset($image_path) ? $image_path : '',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

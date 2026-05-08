<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailVerificationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // ABSTRACTAPI VERIFICATION - COMMENTÉE (TEMPORAIREMENT DÉSACTIVÉE)
        // $emailService = new EmailVerificationService();
        // $verification = $emailService->verify($request->email);
        //
        // if (!$verification['is_valid']) {
        //     return back()->withErrors([
        //         'email' => 'Cet email n\'existe pas ou n\'est pas valide.'
        //     ])->withInput();
        // }

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Envoi de l'email de vérification (Brevo)
        event(new Registered($user));

        return redirect('/login')->with('status', 'Un lien de vérification a été envoyé à votre adresse email.');
    }
}

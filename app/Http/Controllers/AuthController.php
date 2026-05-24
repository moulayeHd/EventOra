<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('connexion');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'Email ou mot de passe incorrect.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended($this->redirectByRole(Auth::user()));
    }

    public function showRegister()
    {
        return view('inscription');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'prenom' => ['required', 'string', 'max:100'],
            'nom' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in([
                User::ROLE_UTILISATEUR,
                User::ROLE_ORGANISATEUR,
                User::ROLE_ADMINISTRATEUR,
            ])],
        ]);

        $user = User::create([
            'name' => trim($validated['prenom'].' '.$validated['nom']),
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
        ]);

        Auth::login($user);

        return redirect($this->redirectByRole($user));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    private function redirectByRole(User $user): string
    {
        if ($user->isAdmin()) {
            return route('admin.dashboard');
        }

        if ($user->isOrganisateur()) {
            return route('organisateur');
        }

        return route('events');
    }
}

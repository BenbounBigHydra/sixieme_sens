<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Gère la tentative de connexion.
     */
    public function login(Request $request)
    {
        // 1. Validation des données reçues (email et password uniquement)
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Tentative de connexion via le Guard de Laravel
        // Auth::attempt va vérifier si l'email existe et si le password correspond en DB
        if (Auth::attempt($credentials)) {

            // 3. Succès : On régénère la session pour des raisons de sécurité (anti-fixation)
            // Cela va créer/mettre à jour la ligne correspondante dans votre table 'sessions'
            $request->session()->regenerate();

            // 4. Redirection vers la page initialement demandée (ex: /admin)
            // ou vers une route par défaut si l'admin est allé directement sur /login
            return redirect()->route('admin.dashboard'); // Assurez-vous d'avoir une route nommée 'admin.dashboard' pour la page d'accueil de l'admin
            // Note : vous pouvez aussi utiliser redirect()->intended(route('nom_de_votre_route_admin'));
        }

        // 5. Échec : Si les identifiants sont faux, on retourne au formulaire avec une erreur
        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email'); // Permet de pré-remplir l'email pour éviter à l'admin de le retaper
    }
}

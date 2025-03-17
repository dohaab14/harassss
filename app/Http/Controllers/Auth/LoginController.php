<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
   
public function login(Request $request)
{
    // Valider les données
    $request->validate([
        'email' => 'required|email',
        'mdp' => 'required'
    ]);

    // Chercher l'utilisateur dans la base de données
    $user = User::where('email', $request->email)->first();

    // Vérifier si l'utilisateur existe et comparer le mot de passe en clair
    if ($user && $user->mdp === $request->mdp) {
        Auth::login($user);
        return redirect()->intended('/');
    }

    return back()->withErrors(['email' => 'Identifiants incorrects.']);
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function showLoginForm()
{
    return view('auth.login');
}

}

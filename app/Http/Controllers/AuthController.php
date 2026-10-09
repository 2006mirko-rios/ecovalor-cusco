<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesar Inicio de Sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'dni' => 'required|digits:8',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/inicio');
        }

        return back()->withErrors([
            'dni' => 'El DNI o la contraseña no coinciden con nuestros registros.',
        ])->onlyInput('dni');
    }

    // Mostrar formulario de Registro
    public function showRegister()
    {
        return view('auth.register');
    }

       public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'dni'      => 'required|string|size:8|unique:users,dni',
            'telefono' => 'nullable|string|max:15',
            'email'    => 'required|email|unique:users,email',
            'distrito' => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'            => $validated['name'],
            'dni'             => $validated['dni'],
            'telefono'        => $validated['telefono'] ?? null,
            'email'           => $validated['email'],
            'direccion'       => $validated['distrito'], // Guarda el distrito seleccionado
            'password'        => Hash::make($validated['password']),
            'puntos_actuales' => 50, // ¡50 puntos de bienvenida!
            'nivel'           => 'Verde',
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', '¡Bienvenido a EcoValor Cusco! Ganaste 50 puntos.');
    }

    // Cerrar Sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

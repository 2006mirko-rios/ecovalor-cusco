<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Canje;

class PerfilController extends Controller
{
    public function index() {
        $user = Auth::user();
        $misCanjes = Canje::where('user_id', $user->id)->with('beneficio')->latest()->get();
        return view('perfil.index', compact('user', 'misCanjes'));
    }

    public function actualizar(Request $request) {
        $user = Auth::user();
        $request->validate([
            'name'     => 'required|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'distrito' => 'required|string',
        ]);

        $user->update($request->only('name', 'telefono', 'distrito'));
        return back()->with('success', 'Tus datos fueron actualizados correctamente.');
    }
}

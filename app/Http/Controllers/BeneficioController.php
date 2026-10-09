<?php

namespace App\Http\Controllers;

use App\Models\Beneficio;
use App\Models\Canje;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BeneficioController extends Controller
{
    public function index() {
        $user = Auth::user();
        $beneficios = Beneficio::where('stock', '>', 0)->get();
        return view('beneficios.index', compact('user', 'beneficios'));
    }

    public function show($id) {
        $user = Auth::user();
        $beneficio = Beneficio::findOrFail($id);
        return view('beneficios.show', compact('user', 'beneficio'));
    }

    public function canjear($id) {
        $user = Auth::user();
        $beneficio = Beneficio::findOrFail($id);

        if ($user->puntos_disponibles < $beneficio->puntos_requeridos) {
            return back()->with('error', 'No tienes suficientes puntos disponibles para este canje.');
        }

        if ($beneficio->stock <= 0) {
            return back()->with('error', 'Lo sentimos, este beneficio está agotado.');
        }

        DB::transaction(function () use ($user, $beneficio) {
            $user->increment('puntos_canjeados', $beneficio->puntos_requeridos);
            $beneficio->decrement('stock');

            Canje::create([
                'user_id'           => $user->id,
                'beneficio_id'      => $beneficio->id,
                'puntos_utilizados' => $beneficio->puntos_requeridos,
                'codigo_cupon'      => 'ECO-' . strtoupper(Str::random(6)),
                'estado'            => 'activo',
            ]);
        });

        return redirect()->route('perfil.index')->with('success', '¡Canje realizado con éxito! Tu cupón está disponible en tu perfil.');
    }
}


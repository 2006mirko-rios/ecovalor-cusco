<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PuntoAcopio;
use App\Models\Entrega;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntregaController extends Controller
{
    public function escanear() {
        $puntos = PuntoAcopio::where('activo', true)->get();
        return view('entrega.escanear', compact('puntos'));
    }

    public function formRegistro($codigo) {
        $punto = PuntoAcopio::where('codigo_qr', $codigo)->firstOrFail();
        $materiales = Entrega::FACTOR_PUNTOS ?? Entrega::FACTORES_PUNTOS;
        return view('entrega.formulario', compact('punto', 'materiales'));
    }

    public function guardar(Request $request) {
        $request->validate([
            'punto_acopio_id' => 'required|exists:puntos_acopio,id',
            'material'        => 'required|string',
            'peso_kg'         => 'required|numeric|min:0.1|max:200',
        ]);

        $user = Auth::user();
        $puntosGanados = Entrega::calcularPuntos($request->material, (float) $request->peso_kg);

        DB::transaction(function () use ($user, $request, $puntosGanados) {
            Entrega::create([
                'user_id'         => $user->id,
                'punto_acopio_id' => $request->punto_acopio_id,
                'material'        => $request->material,
                'peso_kg'         => $request->peso_kg,
                'puntos_ganados'  => $puntosGanados,
            ]);

            $user->increment('puntos_acumulados', $puntosGanados);
        });

        return redirect()->route('entrega.historial')->with('success', "¡Entrega registrada con éxito! Ganaste {$puntosGanados} EcoPuntos.");
    }

    public function historial() {
        $user = Auth::user();
        $entregas = Entrega::where('user_id', $user->id)->with('puntoAcopio')->latest()->paginate(15);
        return view('entrega.historial', compact('user', 'entregas'));
    }
}

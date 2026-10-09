<?php

namespace App\Http\Controllers;

use App\Models\PuntoAcopio;

class MapaController extends Controller
{
    public function index() {
        $puntos = PuntoAcopio::where('activo', true)->get();
        return view('mapa.index', compact('puntos'));
    }
}

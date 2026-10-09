<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Entrega;
use App\Models\Beneficio;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user();
        $ultimasEntregas = Entrega::where('user_id', $user->id)->with('puntoAcopio')->latest()->take(3)->get();
        $beneficiosDestacados = Beneficio::where('stock', '>', 0)->take(2)->get();

        return view('home', compact('user', 'ultimasEntregas', 'beneficiosDestacados'));
    }

    public function puntos() {
        $user = Auth::user();
        $historial = Entrega::where('user_id', $user->id)->latest()->paginate(10);
        return view('puntos.index', compact('user', 'historial'));
    }
}

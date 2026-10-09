@extends('layouts.app')
@section('title', 'Registrar Material')

@section('content')
<div class="p-6">
    <a href="{{ route('entrega.escanear') }}" class="inline-flex items-center text-emerald-800 text-sm font-medium mb-4">
        <i class="bi bi-arrow-left mr-1"></i> Volver al Escáner
    </a>

    <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-xl mb-5">
        <p class="text-xs text-emerald-800 font-bold">{{ $punto->nombre }}</p>
        <p class="text-[11px] text-emerald-600">{{ $punto->direccion }} - {{ $punto->distrito }}</p>
    </div>

    <form action="{{ route('entrega.guardar') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="punto_acopio_id" value="{{ $punto->id }}">

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Tipo de Material</label>
            <select name="material" class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-300">
                @foreach($materiales as $mat => $puntosKg)
                    <option value="{{ $mat }}">{{ $mat }} ({{ $puntosKg }} pts / kg)</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Peso en Kilogramos (kg)</label>
            <input type="number" step="0.1" name="peso_kg" required placeholder="Ej. 2.5"
                   class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-300">
        </div>

        <button type="submit" class="w-full py-3 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold rounded-xl shadow transition text-sm">
            Confirmar y Canjear Puntos
        </button>
    </form>
</div>
@endsection

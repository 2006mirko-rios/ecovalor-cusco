@extends('layouts.app')
@section('title', 'Historial de Entregas')

@section('content')
<div class="p-5">
    <h3 class="text-base font-bold text-slate-800 mb-4">Historial de Reciclaje</h3>
    <div class="space-y-2">
        @forelse($entregas as $entrega)
            <div class="bg-white p-3 rounded-xl border border-slate-200 flex justify-between items-center text-xs">
                <div>
                    <p class="font-bold text-slate-800">{{ $entrega->material }}</p>
                    <p class="text-[10px] text-slate-400">{{ $entrega->puntoAcopio->nombre }} • {{ $entrega->peso_kg }} kg</p>
                    <span class="text-[9px] text-slate-400">{{ $entrega->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <span class="font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded">
                    +{{ $entrega->puntos_ganados }} pts
                </span>
            </div>
        @empty
            <p class="text-xs text-slate-400 text-center py-8">No hay registros de entrega todavía.</p>
        @endforelse
    </div>
</div>
@endsection


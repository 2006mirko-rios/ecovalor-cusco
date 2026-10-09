@extends('layouts.app')
@section('title', 'Historial de Entregas - EcoValor Cusco')

@push('styles')
<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush

@section('content')
<div class="relative w-full h-full min-h-screen flex flex-col bg-slate-950 text-slate-100 overflow-hidden">

    <!-- ========================================== -->
    <!-- FONDO AMBIENTAL CON VELO OSCURO            -->
    <!-- ========================================== -->
    <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden">
        <img src="{{ asset('imagen/entorno.jpg') }}"
             alt="Fondo Cusco"
             class="absolute inset-0 w-full h-full object-cover opacity-700 filter saturate-125">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950/95 to-slate-950"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 bg-emerald-500/15 rounded-full blur-3xl"></div>
    </div>

    <!-- ========================================== -->
    <!-- CONTENIDO PRINCIPAL                        -->
    <!-- ========================================== -->
    <div class="relative z-10 flex-1 overflow-y-auto no-scrollbar p-5 space-y-5 max-w-md mx-auto w-full">

        <!-- Barra Superior con Botón Volver y Mini Logo -->
        <div class="flex items-center justify-between pt-1">
            <a href="{{ route('home') }}"
               class="w-10 h-10 rounded-2xl bg-slate-900/80 border border-slate-800 text-slate-300 hover:text-white flex items-center justify-center transition active:scale-95 shadow">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>

            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-white/95 p-0.5 shadow-sm overflow-hidden flex items-center justify-center border border-emerald-400/40">
                    <img src="{{ asset('imagen/logo.png') }}" alt="Logo" class="w-full h-full object-contain rounded-full">
                </div>
                <div class="text-left">
                    <p class="text-[10px] uppercase tracking-widest text-emerald-400 font-bold leading-tight">Cusco Limpio</p>
                    <h2 class="text-sm font-bold text-white leading-tight">Historial de Reciclaje</h2>
                </div>
            </div>

            <a href="{{ route('entrega.escanear') }}"
               class="w-10 h-10 rounded-2xl bg-emerald-600/30 border border-emerald-500/40 text-emerald-300 hover:text-white flex items-center justify-center transition active:scale-95 shadow"
               title="Escanear nueva entrega">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </a>
        </div>

        <!-- Tarjeta de Resumen con Marca de Agua del Logo -->
        <div class="relative bg-gradient-to-br from-emerald-800 via-emerald-700 to-teal-900 rounded-3xl p-5 text-white shadow-xl shadow-emerald-950/60 border border-emerald-400/25 overflow-hidden">
            <!-- Marca de agua transparente del logo EcoValor -->
            <div class="absolute -right-5 -bottom-5 w-32 h-32 rounded-full overflow-hidden pointer-events-none select-none opacity-20 filter contrast-125">
                <img src="{{ asset('imagen/Logo.png') }}"
                     alt="Marca de agua"
                     class="w-full h-full object-contain mix-blend-screen">
            </div>

            <div class="relative z-10">
                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-100">Impacto Positivo</span>
                <h3 class="text-xl font-extrabold text-white mt-0.5">Tus Aportes Ambientales</h3>

                <div class="grid grid-cols-3 gap-2 mt-4 pt-3 border-t border-white/10 text-center">
                    <div class="bg-black/20 rounded-xl p-2 border border-white/5">
                        <span class="block text-lg font-black text-white leading-tight">
                            {{ count($entregas ?? []) }}
                        </span>
                        <span class="text-[10px] text-emerald-200">Entregas</span>
                    </div>

                    <div class="bg-black/20 rounded-xl p-2 border border-white/5">
                        <span class="block text-lg font-black text-emerald-300 leading-tight">
                            {{ number_format($entregas->sum('peso_kg') ?? 0, 1) }}
                        </span>
                        <span class="text-[10px] text-emerald-200">Kilos (kg)</span>
                    </div>

                    <div class="bg-black/20 rounded-xl p-2 border border-white/5">
                        <span class="block text-lg font-black text-teal-300 leading-tight">
                            +{{ number_format($entregas->sum('puntos_ganados') ?? 0) }}
                        </span>
                        <span class="text-[10px] text-emerald-200">Puntos</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista del Historial -->
        <div class="space-y-3 pb-6">
            <div class="flex items-center justify-between">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Registro Cronológico</h4>
                <span class="text-[11px] text-emerald-400 font-semibold bg-emerald-500/10 px-2 py-0.5 rounded-full border border-emerald-500/20">
                    {{ count($entregas ?? []) }} registros
                </span>
            </div>

            @forelse($entregas as $entrega)
                <div class="group bg-slate-900/80 hover:bg-slate-900 border border-slate-800/80 hover:border-emerald-500/30 p-3.5 rounded-2xl flex items-center justify-between shadow-sm transition">

                    <div class="flex items-center gap-3">
                        <!-- Icono decorativo según material -->
                        <div class="w-11 h-11 rounded-2xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center font-bold text-base shrink-0 group-hover:scale-105 transition-transform">
                            ♻️
                        </div>

                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-bold text-white leading-tight capitalize">
                                    {{ $entrega->material }}
                                </p>
                                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-slate-800 text-emerald-300 border border-slate-700">
                                    {{ $entrega->peso_kg }} kg
                                </span>
                            </div>

                            <p class="text-xs text-slate-400 mt-1 flex items-center gap-1">
                                <svg class="w-3 h-3 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $entrega->puntoAcopio->nombre ?? 'Punto Cusco' }}
                            </p>

                            <p class="text-[10px] text-slate-500 mt-0.5">
                                {{ $entrega->created_at ? $entrega->created_at->format('d/m/Y · h:i A') : 'Fecha no registrada' }}
                            </p>
                        </div>
                    </div>

                    <!-- Insignia de EcoPuntos -->
                    <div class="text-right shrink-0">
                        <span class="inline-block font-extrabold text-xs text-emerald-300 bg-emerald-500/20 border border-emerald-500/30 px-2.5 py-1 rounded-xl shadow-sm">
                            +{{ $entrega->puntos_ganados }} pts
                        </span>
                    </div>

                </div>
            @empty
                <!-- Estado vacío interactivo -->
                <div class="bg-slate-900/50 border border-dashed border-slate-800 rounded-3xl p-8 text-center">
                    <div class="w-14 h-14 mx-auto rounded-full bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-2xl mb-3">
                        🌱
                    </div>
                    <h5 class="text-sm font-bold text-white mb-1">Aún no registras entregas</h5>
                    <p class="text-xs text-slate-400 max-w-xs mx-auto mb-4 leading-relaxed">
                        Acércate a un punto de acopio en Cusco, deposita tus botellas o cartón y escanea el código para ver tus puntos aquí.
                    </p>
                    <a href="{{ route('entrega.escanear') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-lg shadow-emerald-950/50 active:scale-95 transition">
                        Escanear Código QR
                    </a>
                </div>
            @endforelse

            <!-- Paginación si existe -->
            @if(method_exists($entregas, 'links'))
                <div class="pt-2">
                    {{ $entregas->links() }}
                </div>
            @endif
        </div>

    </div>

</div>
@endsection

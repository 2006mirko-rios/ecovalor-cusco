@extends('layouts.app')
@section('title', 'Mis EcoPuntos')

@section('content')
<!-- Contenedor general centrado y con ancho de app móvil (max-w-sm = ~384px) -->
<div class="min-h-screen bg-slate-950 flex justify-center py-4 px-3">

    <div class="relative w-full max-w-sm bg-slate-900/90 rounded-3xl border border-slate-800 shadow-2xl p-5 overflow-hidden flex flex-col justify-between">

        <!-- ========================================================= -->
        <!-- MARCA DE AGUA DE TU IMAGEN DE ENTORNO (PUBLIC/IMAGEN)    -->
        <!-- ========================================================= -->
        <!-- Cambia 'entorno.png' o 'fondo.jpg' por el nombre real de tu archivo en public/imagen/ -->
         <!-- NUEVO FONDO CLARO Y NÍTIDO -->
        <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
                <!-- Imagen nítida sin filtros oscuros que la apaguen -->
            <img src="{{ asset('imagen/Entorno_Ecovalor.jpg') }}"
         alt="Fondo EcoValor"
         class="w-full h-full object-cover opacity-30 scale-100">

    <!-- Filtro sutil para que el texto siga siendo legible sin oscurecer la foto -->
        <div class="absolute inset-0 bg-slate-950/30 backdrop-blur-[1px]"></div>
</div>


        <!-- ========================================================= -->
        <!-- CONTENIDO PRINCIPAL                                       -->
        <!-- ========================================================= -->
        <div class="relative z-10 space-y-5">

            <!-- Cabecera compacta -->
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}"
                   class="w-9 h-9 rounded-xl bg-slate-800/80 border border-slate-700/60 text-slate-300 hover:text-white flex items-center justify-center transition active:scale-95 shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div class="text-center">
                    <p class="text-[10px] uppercase tracking-widest text-emerald-400 font-bold">EcoValor Cusco</p>
                    <h2 class="text-sm font-bold text-white">Mis EcoPuntos</h2>
                </div>
                <a href="{{ route('beneficios.index') }}"
                   class="w-9 h-9 rounded-xl bg-slate-800/80 border border-slate-700/60 text-emerald-400 hover:text-emerald-300 flex items-center justify-center transition active:scale-95 shadow" title="Canjes">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                    </svg>
                </a>
            </div>

            <!-- Tarjeta Principal de Puntos Compacta -->
            <div class="relative bg-gradient-to-br from-emerald-800 via-emerald-700 to-teal-900 rounded-2xl p-5 text-white shadow-lg shadow-emerald-950/60 border border-emerald-400/20 overflow-hidden">

                <!-- Silueta de hoja en la esquina -->
                <svg class="absolute -right-5 -bottom-5 w-32 h-32 text-white/10 fill-current pointer-events-none" viewBox="0 0 24 24">
                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 0 0 8 20C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8z"/>
                </svg>

                <div class="relative z-10">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[11px] font-medium text-emerald-100 uppercase tracking-wide">Puntos Disponibles</span>
                        <span class="px-2 py-0.5 bg-black/20 text-emerald-200 text-[10px] font-semibold rounded-full border border-white/10">
                            {{ $user->nivel ?? 'Ciudadano' }}
                        </span>
                    </div>

                    <div class="flex items-baseline gap-1.5 my-1">
                        <h1 class="text-3xl font-extrabold text-white tracking-tight">
                            {{ number_format($user->puntos_disponibles ?? 0) }}
                        </h1>
                        <span class="text-sm font-medium text-emerald-200">pts</span>
                    </div>

                    <!-- Progreso -->
                    <div class="mt-3 pt-3 border-t border-white/10">
                        <div class="flex justify-between text-[11px] text-emerald-100 mb-1">
                            <span>Hacia <strong class="text-white">EcoLíder</strong></span>
                            <span class="font-bold">{{ $user->progreso_nivel ?? 0 }}%</span>
                        </div>
                        <div class="w-full bg-emerald-950/60 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-300 to-teal-200 h-full rounded-full transition-all duration-500"
                                 style="width: {{ min(100, max(0, $user->progreso_nivel ?? 0)) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="grid grid-cols-2 gap-2.5">
                <a href="{{ route('beneficios.index') }}"
                   class="flex items-center justify-center gap-1.5 py-2.5 px-3 bg-emerald-600 hover:bg-emerald-500 active:scale-95 text-white rounded-xl font-semibold text-xs shadow-md shadow-emerald-950/40 transition">
                    <span>🎁</span> Canjear
                </a>
                <a href="{{ route('entrega.escanear') }}"
                   class="flex items-center justify-center gap-1.5 py-2.5 px-3 bg-slate-800 hover:bg-slate-700/80 active:scale-95 border border-slate-700 text-slate-200 rounded-xl font-semibold text-xs transition">
                    <span>📷</span> Escanear QR
                </a>
            </div>

            <!-- Historial de Entregas -->
            <div class="pt-1">
                <div class="flex justify-between items-center mb-2.5">
                    <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Historial Reciente</h4>
                    <span class="text-[10px] text-slate-500">{{ count($historial ?? []) }} mov.</span>
                </div>

                <div class="space-y-2 max-h-72 overflow-y-auto pr-1">
                    @forelse($historial as $item)
                        <div class="bg-slate-800/60 border border-slate-700/50 p-2.5 rounded-xl flex justify-between items-center text-xs">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold text-xs shrink-0">
                                    ♻
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-200 truncate">
                                        {{ $item->material ?? 'Residuos' }}
                                        @if(isset($item->peso_kg))
                                            <span class="text-[10px] text-slate-400 font-normal">({{ $item->peso_kg }} kg)</span>
                                        @endif
                                    </p>
                                    <p class="text-[10px] text-slate-400 truncate">
                                        {{ $item->puntoAcopio->nombre ?? 'Punto Cusco' }}
                                    </p>
                                </div>
                            </div>
                            <span class="font-bold text-xs text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-md shrink-0">
                                +{{ $item->puntos_ganados ?? $item->puntos ?? 0 }}
                            </span>
                        </div>
                    @empty
                        <div class="bg-slate-800/30 border border-dashed border-slate-700/60 rounded-xl p-5 text-center">
                            <p class="text-xs font-medium text-slate-300">Sin entregas registradas</p>
                            <p class="text-[10px] text-slate-500 mt-0.5">Visita un punto de acopio y entrega tus residuos para ganar puntos.</p>
                        </div>
                    @endforelse
                </div>

                @if(method_exists($historial, 'links'))
                    <div class="pt-2">
                        {{ $historial->links() }}
                    </div>
                @endif
            </div>

        </div>

    </div>
</div>
@endsection

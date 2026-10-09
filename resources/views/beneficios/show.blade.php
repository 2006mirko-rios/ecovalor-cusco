@extends('layouts.app')
@section('title', 'Beneficios - EcoValor')

@section('content')
<!-- Contenedor tamaño celular centrado -->
<div class="min-h-screen bg-slate-950 flex justify-center py-4 px-3">
    <div class="relative w-full max-w-sm bg-slate-900/90 rounded-3xl border border-slate-800 shadow-2xl p-5 overflow-hidden flex flex-col justify-between pb-8">

        <!-- Imagen de entorno de fondo -->
        <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
            <img src="{{ asset('imagen/entorno.png') }}"
                 alt="Fondo"
                 class="w-full h-full object-cover opacity-60 scale-100"
                 onerror="this.onerror=null; this.src='{{ asset('images/entorno.png') }}';">
            <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[1px]"></div>
        </div>

        <!-- Contenido -->
        <div class="relative z-10 space-y-4">

            <!-- Cabecera -->
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}"
                   class="w-9 h-9 rounded-xl bg-slate-800/80 border border-slate-700/60 text-slate-300 hover:text-white flex items-center justify-center transition active:scale-95 shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>

                <div class="text-center">
                    <p class="text-[10px] uppercase tracking-widest text-emerald-400 font-bold">Catálogo</p>
                    <h2 class="text-sm font-bold text-white">Canjear EcoPuntos</h2>
                </div>

                <!-- Puntos del usuario -->
                <a href="{{ route('puntos.index') }}" class="flex items-center gap-1 bg-emerald-500/20 border border-emerald-500/40 px-2.5 py-1 rounded-xl text-emerald-300 text-xs font-bold">
                    <span>🌱</span>
                    <span>{{ number_format(auth()->user()->puntos_disponibles ?? 0) }}</span>
                </a>
            </div>

            <!-- Banner Verde -->
            <div class="bg-gradient-to-r from-emerald-800/90 to-teal-900/90 border border-emerald-500/30 rounded-2xl p-3.5 text-white shadow-md flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-emerald-100">¡Canjea tus puntos!</p>
                    <p class="text-[10px] text-emerald-200/80 mt-0.5">Premios y descuentos en comercios de Cusco.</p>
                </div>
                <span class="text-2xl">🎁</span>
            </div>

            <!-- Lista de Premios y Beneficios -->
            <div class="space-y-3 max-h-[460px] overflow-y-auto pr-1">
                @forelse($beneficios as $beneficio)
                    @php
                        $userPuntos = auth()->user()->puntos_disponibles ?? 0;
                        $puntosReq = $beneficio->puntos_requeridos ?? $beneficio->puntos ?? 100;
                        $alcanza = $userPuntos >= $puntosReq;
                    @endphp

                    <div class="bg-slate-800/70 border border-slate-700/60 rounded-2xl p-3.5 transition shadow-sm">
                        <div class="flex gap-3">
                            <!-- Ícono / Foto -->
                            <div class="w-14 h-14 rounded-xl bg-slate-900 border border-slate-700/60 overflow-hidden shrink-0 flex items-center justify-center">
                                @if(!empty($beneficio->imagen))
                                    <img src="{{ asset('storage/' . $beneficio->imagen) }}" alt="{{ $beneficio->nombre }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-2xl">🌿</span>
                                @endif
                            </div>

                            <!-- Datos del beneficio -->
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <span class="text-[10px] text-emerald-400 font-semibold uppercase tracking-wider truncate">
                                        {{ $beneficio->comercio_aliado ?? 'Aliado Cusco' }}
                                    </span>
                                    <span class="px-2 py-0.5 rounded-md bg-emerald-500/15 text-emerald-300 font-extrabold text-xs shrink-0">
                                        {{ number_format($puntosReq) }} pts
                                    </span>
                                </div>

                                <h3 class="text-xs font-bold text-white truncate mt-0.5">
                                    {{ $beneficio->nombre ?? 'Descuento Ecológico' }}
                                </h3>

                                <div class="mt-2.5 flex items-center justify-between">
                                    <span class="text-[10px] text-slate-400">
                                        Stock: {{ $beneficio->stock ?? 'Disponible' }}
                                    </span>

                                    @if($alcanza)
                                        <a href="{{ route('beneficios.show', $beneficio->id) }}"
                                           class="px-3 py-1 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[11px] rounded-lg transition active:scale-95 shadow">
                                            Canjear &rarr;
                                        </a>
                                    @else
                                        <span class="px-2 py-0.5 bg-slate-700/60 text-slate-400 text-[10px] rounded-md font-medium">
                                            Faltan {{ $puntosReq - $userPuntos }} pts
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Si la tabla de la base de datos aún no tiene registros -->
                    <div class="bg-slate-800/40 border border-dashed border-slate-700 rounded-2xl p-6 text-center">
                        <span class="text-3xl block mb-2">🎁</span>
                        <p class="text-xs font-semibold text-slate-300">Próximamente beneficios</p>
                        <p class="text-[10px] text-slate-500 mt-1">Estamos sumando comercios en Cusco para que canjees tus puntos.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Inicio')

@section('content')
<div class="relative min-h-screen bg-slate-950 text-slate-100 p-5 overflow-hidden">

    <!-- ========================================== -->
    <!-- FONDO AMBIENTAL / MARCA DE AGUA DEL ENTORNO -->
    <!-- ========================================== -->
    <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden">
        <!-- Resplandor verde superior (luz ambiental) -->
        <div class="absolute -top-24 -left-24 w-80 h-80 bg-emerald-500/15 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 -right-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>

        <!-- Silueta de agua ecológica en el fondo general -->
        <svg class="absolute top-10 right-[-30px] w-72 h-72 text-emerald-500/[0.04] fill-current" viewBox="0 0 24 24">
            <path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 0 0 8 20C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8z"/>
        </svg>
    </div>

    <div class="relative z-10 max-w-md mx-auto space-y-6">

        <!-- ========================================== -->
        <!-- SALUDO Y NIVEL CIUDADANO                  -->
        <!-- ========================================== -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-400 p-[2px] shadow-md shadow-emerald-950/50">
                    <div class="w-full h-full bg-slate-900 rounded-full flex items-center justify-center font-bold text-sm text-emerald-300">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                </div>
                <div>
                    <p class="text-[11px] uppercase tracking-wider text-emerald-400 font-semibold">Cusco Sostenible</p>
                    <h3 class="text-base font-bold text-white leading-tight">{{ $user->name }}</h3>
                </div>
            </div>

            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs font-semibold rounded-full shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                {{ $user->nivel }}
            </span>
        </div>

        <!-- ========================================== -->
        <!-- TARJETA DE PUNTOS CON WATERMARK DEL LOGO  -->
        <!-- ========================================== -->
        <div class="relative bg-gradient-to-br from-emerald-800 via-emerald-700 to-teal-900 rounded-3xl p-6 text-white shadow-xl shadow-emerald-950/50 border border-emerald-500/20 overflow-hidden">

            <!-- MARCA DE AGUA DEL LOGO EN LA TARJETA -->
            <!-- Si tienes una imagen del logo en public/images/logo.png, puedes descomentar la siguiente línea: -->
            <!-- <img src="{{ asset('images/logo.png') }}" alt="Logo" class="absolute -right-6 -bottom-6 w-44 h-44 object-contain opacity-15 pointer-events-none select-none"> -->

            <!-- Logo ecológico vectorial en filigrana/watermark -->
            <svg class="absolute -right-8 -bottom-8 w-48 h-48 text-white/10 fill-current pointer-events-none select-none" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
            </svg>

            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium text-emerald-200 tracking-wide uppercase">EcoPuntos Disponibles</span>
                    <a href="{{ route('puntos.index') }}" class="text-xs bg-white/15 hover:bg-white/25 active:scale-95 px-3 py-1 rounded-full backdrop-blur-md transition flex items-center gap-1 border border-white/10">
                        Detalles
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="mt-2 flex items-baseline gap-2">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white drop-shadow-sm">
                        {{ number_format($user->puntos_disponibles ?? 0) }}
                    </h1>
                    <span class="text-base text-emerald-200 font-medium">pts</span>
                </div>

                <div class="mt-5 pt-4 border-t border-white/10">
                    <div class="flex justify-between text-xs text-emerald-100 font-medium mb-2">
                        <span>Progreso hacia <strong class="text-white">EcoLíder</strong></span>
                        <span class="font-bold">{{ $user->progreso_nivel ?? 0 }}%</span>
                    </div>
                    <div class="w-full bg-emerald-950/60 rounded-full h-2 p-[2px] backdrop-blur-sm">
                        <div class="bg-gradient-to-r from-emerald-300 to-teal-200 h-full rounded-full transition-all duration-500 shadow-sm"
                             style="width: {{ min(100, max(0, $user->progreso_nivel ?? 0)) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- ACCESOS RÁPIDOS                            -->
        <!-- ========================================== -->
        <div>
            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Acciones Rápidas</h4>
            <div class="grid grid-cols-2 gap-3">

                <!-- Botón Escanear QR -->
                <a href="{{ route('entrega.escanear') }}"
                   class="group relative bg-slate-900/80 hover:bg-slate-800/80 active:scale-[0.98] border border-slate-800 hover:border-emerald-500/50 p-4 rounded-2xl transition duration-200 flex flex-col justify-between overflow-hidden shadow-lg shadow-black/30">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center mb-3 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white group-hover:text-emerald-300 transition">Escanear QR</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">Registrar residuo</p>
                    </div>
                </a>

                <!-- Botón Puntos de Acopio -->
                <a href="{{ route('mapa.index') }}"
                   class="group relative bg-slate-900/80 hover:bg-slate-800/80 active:scale-[0.98] border border-slate-800 hover:border-teal-500/50 p-4 rounded-2xl transition duration-200 flex flex-col justify-between overflow-hidden shadow-lg shadow-black/30">
                    <div class="w-12 h-12 rounded-xl bg-teal-500/15 text-teal-400 flex items-center justify-center mb-3 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white group-hover:text-teal-300 transition">Puntos Acopio</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">Mapa de Cusco</p>
                    </div>
                </a>

            </div>
        </div>

        <!-- ========================================== -->
        <!-- ACTIVIDAD RECIENTE                         -->
        <!-- ========================================== -->
        <div>
            <div class="flex justify-between items-center mb-3">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Actividad Reciente</h4>
                <a href="{{ route('entrega.historial') }}" class="text-xs text-emerald-400 hover:text-emerald-300 font-medium transition">
                    Ver historial &rarr;
                </a>
            </div>

            <div class="space-y-2.5">
                @forelse($ultimasEntregas as $entrega)
                    <div class="bg-slate-900/80 border border-slate-800/80 p-3.5 rounded-2xl flex justify-between items-center shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold text-xs">
                                ♻
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-200">
                                    {{ $entrega->material }} <span class="text-xs text-slate-400">({{ $entrega->peso_kg }} kg)</span>
                                </p>
                                <p class="text-[11px] text-slate-400">{{ $entrega->puntoAcopio->nombre ?? 'Punto de acopio' }}</p>
                            </div>
                        </div>
                        <span class="font-bold text-sm text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-lg">
                            +{{ $entrega->puntos_ganados }} pts
                        </span>
                    </div>
                @empty
                    <div class="bg-slate-900/40 border border-dashed border-slate-800 rounded-2xl p-6 text-center">
                        <div class="w-12 h-12 rounded-full bg-slate-800 text-slate-500 flex items-center justify-center mx-auto mb-2 text-xl">
                            🌱
                        </div>
                        <p class="text-sm font-semibold text-slate-300">Aún no has registrado entregas</p>
                        <p class="text-xs text-slate-500 mt-1 max-w-xs mx-auto">Acércate a un punto de acopio en Cusco y escanea el código para acumular tus primeros EcoPuntos.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection

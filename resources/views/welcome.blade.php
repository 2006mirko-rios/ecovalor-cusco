@extends('layouts.app')

@section('title', 'Bienvenido - EcoValor Cusco')

@section('content')
<div class="relative w-full h-full min-h-[640px] flex flex-col justify-between p-6 overflow-hidden select-none">

    <!-- Imagen de fondo real (Plaza de Cusco / Entorno) con degradado -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <img src="{{ asset('imagen/entorno.jpg') }}"
             alt="Cusco Sostenible"
             class="w-full h-full object-cover"
             onerror="this.src='{{ asset('imagen/logo.png') }}';">
        <!-- Filtro degradado: oscuro arriba y abajo para que el texto y botones resalten con total nitidez -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#0d1d17]/80 via-black/35 to-[#081811]/95"></div>
    </div>

    <!-- Parte Superior: Insignia circular y títulos -->
    <div class="relative z-10 pt-6 flex flex-col items-center text-center">

        <!-- Logo en círculo blanco con relieve -->
        <div class="w-24 h-24 rounded-full bg-white p-2.5 shadow-2xl shadow-black/70 border-2 border-emerald-400/50 flex items-center justify-center mb-3 transition hover:scale-105 duration-300">
            <img src="{{ asset('imagen/logo.png') }}"
                 alt="Logo EcoValor"
                 class="w-full h-full object-contain rounded-full"
                 onerror="this.src='{{ asset('imagen/Logo_Ecovalor.jpg') }}';">
        </div>

        <h1 class="text-2xl font-black text-white tracking-tight drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
            EcoValor Cusco
        </h1>
        <p class="text-xs font-semibold text-emerald-300 mt-1 drop-shadow-[0_1px_2px_rgba(0,0,0,0.8)]">
            ¡Recicla, Separa y Gana en la Ciudad Imperial!
        </p>
    </div>

    <!-- Parte Inferior: Tarjeta de bienvenida y Botones -->
    <div class="relative z-10 pb-2 space-y-3">

        <!-- Tarjeta de cristal esmerilado con mensaje -->
        <div class="p-3.5 rounded-2xl bg-black/55 backdrop-blur-md border border-white/15 text-center shadow-lg">
            <p class="text-xs text-slate-100 font-medium leading-relaxed drop-shadow">
                Únete a la red ciudadana de reciclaje y canjea increíbles beneficios.
            </p>
        </div>

        <!-- Botones de Acción idénticos a tu pantalla deseada -->
        <div class="space-y-2.5 pt-1">
            <!-- Iniciar Sesión (Blanco puro contrastado) -->
            <a href="{{ route('login') }}"
               class="w-full py-3.5 bg-white hover:bg-slate-100 text-slate-900 font-extrabold text-sm rounded-2xl shadow-xl transition active:scale-95 flex items-center justify-center text-center">
                Iniciar Sesión
            </a>

            <!-- Registrarse (Verde esmeralda vivo) -->
            <a href="{{ route('register') }}"
               class="w-full py-3.5 bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 hover:from-emerald-500 hover:to-teal-500 text-white font-extrabold text-sm rounded-2xl shadow-xl shadow-emerald-950/60 transition active:scale-95 flex items-center justify-center text-center border border-emerald-400/30">
                Registrarse
            </a>
        </div>

        <p class="text-[10px] text-center text-emerald-200/70 pt-1 font-medium">
            EcoValor • Cusco Sostenible
        </p>
    </div>

</div>
@endsection

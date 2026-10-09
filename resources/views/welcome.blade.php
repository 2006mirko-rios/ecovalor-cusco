@extends('layouts.app')

@section('title', 'Bienvenido a EcoValor Cusco')

@section('content')
<!-- Contenedor Principal: Ocupa el 100% del alto y ancho del marco -->
<div class="relative w-full h-full flex flex-col justify-between overflow-hidden">

    <!-- Capa 1: Imagen de Entorno (Cusco) cubriendo toda la superficie -->
    <div class="absolute inset-0 z-0">
        <img
            src="{{ asset('imagen/icono-512.png') }}"
            alt="Entorno Cusco"
            class="w-full h-full object-cover object-center"
        >
        <!-- Capa 2: Degradado para legibilidad y tono verdusco característico -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-emerald-950/60 to-emerald-950/95"></div>
    </div>

    <!-- Capa 3: Encabezado con Logo y Títulos -->
    <div class="relative z-10 pt-16 px-6 text-center">
        <!-- Logo Circular -->
        <div class="w-28 h-28 mx-auto mb-4 bg-white/95 p-2 rounded-full shadow-2xl backdrop-blur flex items-center justify-center border-4 border-emerald-400">
            <img
                src="{{ asset('imagen/icono-192.png') }}"
                alt="Logo EcoValor Cusco"
                class="w-full h-full object-contain"
            >
        </div>

        <h1 class="text-3xl font-extrabold text-white tracking-wide drop-shadow-lg">
            EcoValor Cusco
        </h1>

        <p class="text-emerald-200 text-sm font-medium mt-2 drop-shadow leading-relaxed">
            ¡Recicla, Separa y Gana en la Ciudad Imperial!
        </p>
    </div>

    <!-- Capa 4: Botones de Acción en la parte inferior -->
    <div class="relative z-10 pb-12 px-6 space-y-3">
        <div class="bg-black/30 backdrop-blur-sm p-3 rounded-2xl border border-white/10 text-center mb-3">
            <p class="text-xs text-emerald-100 font-light">
                Únete a la red ciudadana de reciclaje y canjea increíbles beneficios.
            </p>
        </div>

        <a href="{{ route('login') }}" class="block w-full py-3.5 text-center font-semibold text-emerald-950 bg-white hover:bg-emerald-50 active:scale-[0.98] rounded-xl shadow-lg transition">
            Iniciar Sesión
        </a>

        <a href="{{ route('register') }}" class="block w-full py-3.5 text-center font-semibold text-white bg-emerald-600 hover:bg-emerald-500 active:scale-[0.98] border border-emerald-400/40 rounded-xl shadow-lg transition">
            Registrarse
        </a>
    </div>

</div>
@endsection

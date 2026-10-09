@extends('layouts.app')

@section('title', 'Iniciar Sesión - EcoValor Cusco')

@section('content')
<div class="relative w-full h-full flex flex-col justify-between bg-emerald-950 overflow-y-auto">

    <!-- Fondo sutil con imagen de Cusco -->
    <div class="absolute inset-0 z-0 opacity-20">
        <img src="{{ asset('imagen/Entorno_Ecovalor.jpg') }}" alt="Cusco" class="w-full h-full object-cover">
    </div>

    <!-- Encabezado -->
    <div class="relative z-10 pt-8 px-6">
        <a href="{{ route('splash') }}" class="inline-flex items-center text-xs text-emerald-300 hover:text-white mb-4 transition">
            ← Volver al inicio
        </a>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-white rounded-full p-1 border-2 border-emerald-400 flex items-center justify-center shadow-md">
                <img src="{{ asset('imagen/Logo_Ecovalor.jpg') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <h1 class="text-xl font-bold text-white">Iniciar Sesión</h1>
                <p class="text-xs text-emerald-300">Ingresa a tu cuenta </p>
            </div>
        </div>
    </div>

    <!-- Formulario de Login -->
    <div class="relative z-10 px-6 py-4 flex-1 flex flex-col justify-center">

        <!-- Mensajes de Error -->
        @if ($errors->any())
            <div class="mb-4 p-3 bg-rose-500/20 border border-rose-500/50 rounded-xl text-xs text-rose-200">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Campo DNI -->
            <div>
                <label for="dni" class="block text-xs font-medium text-emerald-200 mb-1">DNI (8 dígitos)</label>
                <input
                    type="text"
                    id="dni"
                    name="dni"
                    value="{{ old('dni') }}"
                    required
                    maxlength="8"
                    placeholder="Ej. 70334455"
                    class="w-full px-4 py-3 bg-white/10 border border-emerald-400/30 rounded-xl text-white placeholder-emerald-300/50 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:bg-white/20 transition"
                >
            </div>

            <!-- Campo Contraseña -->
            <div>
                <label for="password" class="block text-xs font-medium text-emerald-200 mb-1">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    placeholder="••••••••"
                    class="w-full px-4 py-3 bg-white/10 border border-emerald-400/30 rounded-xl text-white placeholder-emerald-300/50 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:bg-white/20 transition"
                >
            </div>

            <!-- Botón de Ingreso -->
            <button
                type="submit"
                class="w-full py-3.5 mt-2 text-center font-semibold text-emerald-950 bg-emerald-400 hover:bg-emerald-300 active:scale-[0.98] rounded-xl shadow-lg transition"
            >
                Ingresar al Sistema
            </button>
        </form>

        <!-- Datos Demo para prueba rápida -->
        <div class="mt-4 p-3 bg-white/5 border border-white/10 rounded-xl text-center">
            <p class="text-[11px] text-emerald-200/80 font-mono">
                👤 Demo: DNI <strong>70334455</strong> | Clave: <strong>password</strong>
            </p>
        </div>
    </div>

    <!-- Enlace al Registro -->
    <div class="relative z-10 pb-8 px-6 text-center">
        <p class="text-xs text-emerald-200">
            ¿Aún no tienes cuenta?
            <a href="{{ route('register') }}" class="text-white font-semibold underline hover:text-emerald-300 ml-1">
                Regístrate aquí
            </a>
        </p>
    </div>

</div>
@endsection

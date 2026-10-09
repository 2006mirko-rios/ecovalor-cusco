@extends('layouts.app')

@section('title', 'Registro Ciudadano - EcoValor Cusco')

@section('content')
<div class="relative w-full h-full min-h-[640px] flex flex-col justify-between overflow-hidden text-white font-['Poppins']">

    <!-- 1. IMAGEN DE FONDO (ENTORNO CUSCO) -->
    <img
        src="{{ asset('imagen/Entorno_Ecovalor.jpg') }}"
        alt="Entorno Cusco"
        class="absolute inset-0 w-full h-full object-cover object-center z-0 scale-105"
        onerror="this.onerror=null; this.src='{{ asset('images/entorno-cusco.jpg') }}';"
    >

    <!-- 2. CAPA VERDE ESMERALDA CON DESENFOQUE SUAVE -->
    <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/85 via-emerald-900/80 to-teal-950/95 backdrop-blur-[2px] z-10"></div>

    <!-- 3. CONTENIDO PRINCIPAL -->
    <div class="relative z-20 flex flex-col h-full px-5 py-4 overflow-y-auto">

        <!-- Botón Volver -->
        <div class="flex items-center justify-between mb-3">
            <a href="{{ route('login') }}" class="inline-flex items-center text-xs font-semibold text-emerald-300 hover:text-white transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver al inicio
            </a>
            <span class="text-[10px] bg-emerald-500/20 text-emerald-300 px-2.5 py-0.5 rounded-full border border-emerald-400/30 font-medium">
                Paso 1 de 1
            </span>
        </div>

        <!-- Encabezado con Logo y Título -->
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-white p-0.5 shadow-lg shadow-emerald-950/50 border-2 border-emerald-400 shrink-0">
                <img
                    src="{{ asset('imagen/Logo_Ecovalor.jpg') }}"
                    alt="Logo EcoValor"
                    class="w-full h-full object-cover rounded-full"
                    onerror="this.onerror=null; this.src='{{ asset('images/logo-ecovalor.jpg') }}';"
                >
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-tight text-white leading-tight">Únete a EcoValor</h1>
                <p class="text-xs text-emerald-200/90 font-medium flex items-center gap-1 mt-0.5">
                    🌱 ¡Gana <span class="font-bold text-emerald-300">50 puntos</span> de bienvenida hoy!
                </p>
            </div>
        </div>

        <!-- Alertas de Error de Validación -->
        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-400/50 rounded-xl p-2.5 mb-3 text-xs text-red-200">
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario Ciudadano -->
        <form method="POST" action="{{ route('register.submit') }}" class="space-y-3 flex-1">
            @csrf

            <!-- Nombres y Apellidos -->
            <div>
                <label class="block text-xs font-semibold text-emerald-100 mb-1">Nombres y Apellidos</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Juan Diego Casillas"
                    required
                    class="w-full px-3.5 py-2.5 bg-slate-100 text-slate-800 rounded-xl text-sm font-medium placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 shadow-inner"
                >
            </div>

            <!-- DNI y Teléfono (2 Columnas) -->
            <div class="grid grid-cols-2 gap-2.5">
                <div>
                    <label class="block text-xs font-semibold text-emerald-100 mb-1">DNI (8 dígitos)</label>
                    <input
                        type="text"
                        name="dni"
                        maxlength="8"
                        value="{{ old('dni') }}"
                        placeholder="44526384"
                        required
                        class="w-full px-3.5 py-2.5 bg-slate-100 text-slate-800 rounded-xl text-sm font-medium placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 shadow-inner"
                    >
                </div>
                <div>
                    <label class="block text-xs font-semibold text-emerald-100 mb-1">Teléfono</label>
                    <input
                        type="tel"
                        name="telefono"
                        maxlength="9"
                        value="{{ old('telefono') }}"
                        placeholder="987654321"
                        class="w-full px-3.5 py-2.5 bg-slate-100 text-slate-800 rounded-xl text-sm font-medium placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 shadow-inner"
                    >
                </div>
            </div>

            <!-- Correo Electrónico -->
            <div>
                <label class="block text-xs font-semibold text-emerald-100 mb-1">Correo Electrónico</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="juanjo12@gmail.com"
                    required
                    class="w-full px-3.5 py-2.5 bg-slate-100 text-slate-800 rounded-xl text-sm font-medium placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 shadow-inner"
                >
            </div>

            <!-- Distrito de Cusco -->
            <div>
                <label class="block text-xs font-semibold text-emerald-100 mb-1">Distrito de Cusco</label>
                <div class="relative">
                    <select
                        name="distrito"
                        required
                        class="w-full appearance-none px-3.5 py-2.5 bg-emerald-950/70 border border-emerald-400/60 text-white rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-emerald-400 shadow-inner pr-8"
                    >
                        <option value="Cusco (Centro Histórico)" class="bg-emerald-950 text-white">Cusco (Centro Histórico)</option>
                        <option value="Wánchaq" class="bg-emerald-950 text-white">Wánchaq</option>
                        <option value="San Sebastián" class="bg-emerald-950 text-white">San Sebastián</option>
                        <option value="San Jerónimo" class="bg-emerald-950 text-white">San Jerónimo</option>
                        <option value="Santiago" class="bg-emerald-950 text-white">Santiago</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-emerald-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Contraseña y Confirmar con botón de Ver/Ocultar -->
            <div class="grid grid-cols-2 gap-2.5">
                <!-- Contraseña -->
                <div>
                    <label class="block text-xs font-semibold text-emerald-100 mb-1">Contraseña</label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••"
                            required
                            class="w-full pl-3.5 pr-9 py-2.5 bg-emerald-950/70 border border-emerald-400/60 text-white rounded-xl text-sm font-medium placeholder-emerald-300/40 focus:outline-none focus:ring-2 focus:ring-emerald-400 shadow-inner"
                        >
                        <button
                            type="button"
                            onclick="togglePassword('password', 'eye-pass')"
                            class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-emerald-300 hover:text-white transition focus:outline-none"
                            title="Ver/Ocultar contraseña"
                        >
                            <svg id="eye-pass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Confirmar Contraseña -->
                <div>
                    <label class="block text-xs font-semibold text-emerald-100 mb-1">Confirmar</label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="••••••"
                            required
                            class="w-full pl-3.5 pr-9 py-2.5 bg-emerald-950/70 border border-emerald-400/60 text-white rounded-xl text-sm font-medium placeholder-emerald-300/40 focus:outline-none focus:ring-2 focus:ring-emerald-400 shadow-inner"
                        >
                        <button
                            type="button"
                            onclick="togglePassword('password_confirmation', 'eye-confirm')"
                            class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-emerald-300 hover:text-white transition focus:outline-none"
                            title="Ver/Ocultar contraseña"
                        >
                            <svg id="eye-confirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Botón Crear Cuenta -->
            <button
                type="submit"
                class="w-full mt-3 py-3 px-4 bg-gradient-to-r from-emerald-400 via-teal-300 to-emerald-400 text-slate-900 font-bold text-sm rounded-xl shadow-lg shadow-emerald-500/30 hover:brightness-105 active:scale-[0.99] transition duration-150 uppercase tracking-wide"
            >
                Crear Mi Cuenta Ciudadana
            </button>
        </form>

        <!-- Pie de Página -->
        <div class="text-center pt-3 pb-1">
            <p class="text-xs text-emerald-100/80">
                ¿Ya tienes una cuenta?
                <a href="{{ route('login') }}" class="font-bold text-white hover:text-emerald-300 underline underline-offset-2 ml-1 transition">
                    Inicia sesión aquí
                </a>
            </p>
        </div>

    </div>
</div>

<!-- SCRIPT PARA VER / OCULTAR CONTRASEÑA -->
<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        // Ícono de ojo tachado (ocultar)
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
        `;
    } else {
        input.type = "password";
        // Ícono de ojo abierto (ver)
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        `;
    }
}
</script>
@endsection

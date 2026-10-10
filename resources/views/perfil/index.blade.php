@extends('layouts.app')
@section('title', 'Mi Perfil - EcoValor')

@section('content')
<!-- Fondo amigable: menta/salvia suave con fotografía ambiental tenue -->
<div class="relative min-h-screen bg-gradient-to-b from-emerald-100/60 via-slate-50 to-emerald-50/80 flex justify-center py-5 px-3 overflow-hidden">

    <!-- Fotografía ambiental de entorno con velo suave -->
    <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden">
        <img src="{{ asset('imagen/entorno.jpg') }}"
             alt="Fondo Cusco"
             class="w-full h-full object-cover opacity-60 filter saturate-125">
        <div class="absolute inset-0 bg-gradient-to-b from-emerald-50/70 via-white/80 to-emerald-50/90"></div>
    </div>

    <div class="relative z-10 w-full max-w-sm bg-white/95 backdrop-blur-sm rounded-[28px] border border-emerald-100 shadow-xl shadow-emerald-950/5 overflow-hidden pb-8">

        <!-- Detalle decorativo superior de naturaleza -->
        <div class="absolute -top-12 -right-12 w-36 h-36 bg-emerald-200/50 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute top-20 -left-12 w-28 h-28 bg-teal-200/40 rounded-full blur-xl pointer-events-none"></div>

        <!-- Barra superior con mini logo -->
        <div class="relative z-10 px-5 pt-5 pb-3 flex items-center justify-between border-b border-emerald-100/70">
            <a href="{{ route('home') }}"
               class="w-9 h-9 rounded-2xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 flex items-center justify-center transition active:scale-95 border border-emerald-200/60 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>

            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-white p-0.5 shadow-sm overflow-hidden flex items-center justify-center border border-emerald-300">
                    <img src="{{ asset('imagen/logo.png') }}" alt="Logo" class="w-full h-full object-contain rounded-full">
                </div>
                <h2 class="text-sm font-extrabold text-slate-800 tracking-wide">Mi Perfil</h2>
            </div>

            <button type="button" onclick="document.getElementById('modal-editar-perfil').classList.remove('hidden')"
                    class="text-xs font-bold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 px-3.5 py-1.5 rounded-xl border border-emerald-200/80 transition active:scale-95 shadow-sm">
                Editar
            </button>
        </div>

        <div class="relative z-10 px-5 pt-4 space-y-4">

            <!-- Ficha de Usuario y Avatar -->
            <div class="flex flex-col items-center text-center">
                <div class="relative mb-2">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-tr from-emerald-500 via-teal-400 to-lime-300 p-1 shadow-md shadow-emerald-500/20">
                        <div class="w-full h-full rounded-full bg-emerald-50 flex items-center justify-center text-2xl font-black text-emerald-800 border-2 border-white">
                            {{ strtoupper(substr($user->name ?? 'U', 0, 2)) }}
                        </div>
                    </div>
                    <span class="absolute bottom-0 right-0 w-5 h-5 bg-emerald-500 border-2 border-white rounded-full flex items-center justify-center text-[10px] text-white">✓</span>
                </div>

                <h3 class="text-base font-extrabold text-slate-800">{{ $user->name }}</h3>
                <p class="text-xs text-slate-500 font-medium">{{ $user->email }}</p>

                <div class="flex items-center gap-1.5 mt-2">
                    <span class="text-[11px] font-bold px-3 py-1 bg-emerald-100/60 text-emerald-700 rounded-full border border-emerald-200">
                        🌱 {{ $user->nivel ?? 'EcoCiudadano' }}
                    </span>
                    @if(!empty($user->dni))
                        <span class="text-[11px] font-medium px-2.5 py-1 bg-slate-100 text-slate-600 rounded-full border border-slate-200">
                            DNI {{ $user->dni }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Tarjeta de Puntos con MARCA DE AGUA DEL LOGO -->
            <div class="p-4 rounded-2xl bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 text-white shadow-lg shadow-emerald-600/25 flex items-center justify-between relative overflow-hidden">

                <!-- Logo como marca de agua en la tarjeta -->
                <div class="absolute -right-3 -bottom-3 w-28 h-28 rounded-full overflow-hidden pointer-events-none select-none opacity-20 filter contrast-125">
                    <img src="{{ asset('imagen/logo.png') }}"
                         alt="Logo Marca de Agua"
                         class="w-full h-full object-contain mix-blend-screen">
                </div>

                <div class="relative z-10">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-100">EcoPuntos Disponibles</span>
                    <h4 class="text-2xl font-black mt-0.5 tracking-tight">
                        {{ number_format($user->puntos_disponibles ?? 0) }}
                        <span class="text-xs font-semibold text-emerald-200">pts</span>
                    </h4>
                    <p class="text-[10px] text-emerald-100/90 mt-0.5">Listos para canjear en Cusco</p>
                </div>
                <a href="{{ route('puntos.index') }}"
                   class="relative z-10 text-xs font-extrabold text-emerald-800 bg-white hover:bg-emerald-50 px-3.5 py-2 rounded-xl transition shadow active:scale-95">
                    Ver saldo
                </a>
            </div>

            <!-- Menú de Acciones -->
            <div class="space-y-2.5 pt-1">

                <!-- Mis Cupones -->
                <a href="{{ route('beneficios.index') }}"
                   class="flex items-center justify-between p-3.5 rounded-2xl bg-emerald-50/50 hover:bg-emerald-50 border border-emerald-100/80 transition active:scale-[0.99] shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-base font-bold shadow-sm">
                            🎁
                        </div>
                        <div class="text-left">
                            <p class="text-xs font-bold text-slate-800">Mis Cupones y Beneficios</p>
                            <p class="text-[10px] text-slate-500">Recompensas en comercios aliados</p>
                        </div>
                    </div>
                    <span class="text-xs text-emerald-600 font-bold bg-emerald-100/60 w-6 h-6 rounded-full flex items-center justify-center">›</span>
                </a>

                <!-- Historial de Reciclaje -->
                @if(Route::has('entrega.historial'))
                <a href="{{ route('entrega.historial') }}"
                   class="flex items-center justify-between p-3.5 rounded-2xl bg-emerald-50/50 hover:bg-emerald-50 border border-emerald-100/80 transition active:scale-[0.99] shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-base font-bold shadow-sm">
                            ♻️
                        </div>
                        <div class="text-left">
                            <p class="text-xs font-bold text-slate-800">Historial de Reciclaje</p>
                            <p class="text-[10px] text-slate-500">Pesajes y entregas en Cusco</p>
                        </div>
                    </div>
                    <span class="text-xs text-emerald-600 font-bold bg-emerald-100/60 w-6 h-6 rounded-full flex items-center justify-center">›</span>
                </a>
                @endif

                <!-- Notificaciones al Celular -->
                <div class="flex items-center justify-between p-3.5 rounded-2xl bg-emerald-50/50 border border-emerald-100/80 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center text-base font-bold shadow-sm">
                            🔔
                        </div>
                        <div class="text-left">
                            <p class="text-xs font-bold text-slate-800">Avisos en el celular</p>
                            <p class="text-[10px] text-slate-500" id="estado-notif">Alerta de puntos ganados</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="toggle-notif" onchange="activarNotificaciones(this)" class="sr-only peer">
                        <div class="w-10 h-5 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                    </label>
                </div>

                <!-- Soporte WhatsApp -->
                <a href="https://wa.me/51984000000?text=Hola,%20necesito%20ayuda%20con%20mi%20cuenta%20de%20EcoValor%20Cusco" target="_blank"
                   class="flex items-center justify-between p-3.5 rounded-2xl bg-emerald-50/50 hover:bg-emerald-50 border border-emerald-100/80 transition active:scale-[0.99] shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-base font-bold shadow-sm">
                            💬
                        </div>
                        <div class="text-left">
                            <p class="text-xs font-bold text-slate-800">Soporte por WhatsApp</p>
                            <p class="text-[10px] text-slate-500">Atención a ciudadanos</p>
                        </div>
                    </div>
                    <span class="text-xs text-teal-600 font-bold bg-teal-100/60 w-6 h-6 rounded-full flex items-center justify-center">↗</span>
                </a>
            </div>

            <!-- Botón Cerrar Sesión -->
            <form action="{{ route('logout') }}" method="POST" class="pt-2">
                @csrf
                <button type="submit" onclick="return confirm('¿Deseas cerrar sesión?')"
                        class="w-full py-3 rounded-2xl bg-rose-50 hover:bg-rose-100/80 border border-rose-200/70 text-rose-700 font-extrabold text-xs flex items-center justify-center gap-2 transition active:scale-95 shadow-sm">
                    <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Cerrar Sesión
                </button>
            </form>

        </div>
    </div>
</div>

<!-- Modal para Editar Perfil -->
<div id="modal-editar-perfil" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
    <div class="w-full max-w-xs bg-white rounded-3xl p-5 shadow-2xl border border-emerald-100">
        <div class="flex justify-between items-center mb-3 border-b border-slate-100 pb-2">
            <h3 class="text-sm font-extrabold text-slate-800">Editar mis datos</h3>
            <button type="button" onclick="document.getElementById('modal-editar-perfil').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-lg">✕</button>
        </div>
        <form action="{{ route('perfil.actualizar') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="block text-[11px] font-bold text-slate-600 mb-1">Nombre Completo</label>
                <input type="text" name="name" value="{{ $user->name }}" required
                       class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:border-emerald-500 focus:bg-white transition">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-600 mb-1">Correo Electrónico</label>
                <input type="email" name="email" value="{{ $user->email }}" required
                       class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:border-emerald-500 focus:bg-white transition">
            </div>
            <div class="pt-2 flex gap-2">
                <button type="button" onclick="document.getElementById('modal-editar-perfil').classList.add('hidden')"
                        class="w-1/2 py-2 text-xs font-semibold rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                    Cancelar
                </button>
                <button type="submit"
                        class="w-1/2 py-2 text-xs font-bold rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white shadow-md shadow-emerald-600/20 transition">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('toggle-notif');
    const estado = document.getElementById('estado-notif');
    if ("Notification" in window && Notification.permission === "granted") {
        toggle.checked = true;
        estado.textContent = "Avisos activados";
    }
});

function activarNotificaciones(checkbox) {
    const estado = document.getElementById('estado-notif');
    if (!("Notification" in window)) {
        alert("Tu dispositivo o navegador no soporta notificaciones.");
        checkbox.checked = false;
        return;
    }

    if (checkbox.checked) {
        Notification.requestPermission().then(permission => {
            if (permission === "granted") {
                estado.textContent = "Avisos activados";
                new Notification("EcoValor Cusco", {
                    body: "¡Genial! Te notificaremos cada vez que sumes EcoPuntos.",
                    icon: "{{ asset('imagen/icono-192.png') }}"
                });
            } else {
                checkbox.checked = false;
                estado.textContent = "Permiso no concedido";
            }
        });
    } else {
        estado.textContent = "Avisos desactivados";
    }
}
</script>
@endsection

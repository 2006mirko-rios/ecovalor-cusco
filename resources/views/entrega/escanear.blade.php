@extends('layouts.app')
@section('title', 'Escanear QR de Acopio - EcoValor Cusco')

@push('styles')
<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    #reader { border: none !important; width: 100% !important; height: 100% !important; }
    #reader video {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        border-radius: 1rem !important;
    }
</style>
@endpush

@section('content')
<div class="relative w-full h-full min-h-screen flex flex-col bg-slate-950 text-slate-100 overflow-hidden">

    <!-- Fondo ambiental -->
    <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden">
        <img src="{{ asset('imagen/entorno.jpg') }}"
             alt="Fondo Cusco"
             class="absolute inset-0 w-full h-full object-cover opacity-700 filter saturate-125">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950/95 to-slate-950"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 bg-emerald-500/15 rounded-full blur-3xl"></div>
    </div>

    <!-- Contenido principal -->
    <div class="relative z-10 flex-1 overflow-y-auto no-scrollbar p-5 space-y-4 max-w-md mx-auto w-full">

        <!-- Barra Superior -->
        <div class="flex items-center justify-between pt-1">
            <a href="{{ route('home') }}"
               class="w-10 h-10 rounded-2xl bg-slate-900/80 border border-slate-800 text-slate-300 hover:text-white flex items-center justify-center transition active:scale-95 shadow">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>

            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-white/95 p-0.5 shadow-sm overflow-hidden flex items-center justify-center border border-emerald-400/40">
                    <img src="{{ asset('imagen/logo.png') }}" alt="Logo EcoValor" class="w-full h-full object-contain rounded-full">
                </div>
                <div class="text-left">
                    <p class="text-[10px] uppercase tracking-widest text-emerald-400 font-bold leading-tight">EcoValor Cusco</p>
                    <h2 class="text-sm font-bold text-white leading-tight">Lector de Acopio</h2>
                </div>
            </div>

            <a href="{{ route('mapa.index') }}"
               class="w-10 h-10 rounded-2xl bg-slate-900/80 border border-slate-800 text-teal-300 hover:text-white flex items-center justify-center transition active:scale-95 shadow"
               title="Ver puntos en mapa">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </a>
        </div>

        <div class="text-center">
            <h3 class="text-lg font-black text-white tracking-tight">Escanear Contenedor</h3>
            <p class="text-xs text-slate-300 mt-0.5" id="indicacion-texto">
                Activa la cámara o sube una imagen del código QR
            </p>
        </div>

        <!-- Visor del Lector -->
        <div class="relative bg-black/90 rounded-3xl p-3 border border-emerald-500/30 shadow-2xl shadow-emerald-950/70 overflow-hidden">

            <div class="relative aspect-square w-full rounded-2xl overflow-hidden bg-slate-900/90 flex flex-col items-center justify-center border border-white/5">

                <!-- 1. Pantalla previa (antes de dar permisos) -->
                <div id="pantalla-permiso" class="p-6 text-center flex flex-col items-center justify-center z-20 space-y-3">
                    <div class="w-16 h-16 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center justify-center text-3xl shadow-inner">
                        📷
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white">Permiso de Cámara Requerido</h4>
                        <p class="text-[11px] text-slate-400 mt-1 max-w-[220px] mx-auto leading-relaxed">
                            Necesitamos acceso a tu cámara para escanear el código QR del punto de acopio.
                        </p>
                    </div>

                    <button type="button"
                            onclick="solicitarPermisoYActivarCamara()"
                            id="btn-activar"
                            class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-500 hover:to-teal-400 text-white font-bold text-xs shadow-lg shadow-emerald-950/60 active:scale-95 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        Activar Cámara
                    </button>
                </div>

                <!-- 2. Video de la cámara (se muestra tras aceptar) -->
                <div id="reader" class="hidden w-full h-full"></div>

                <!-- 3. Marco guía de enfoque (activo solo cuando la cámara está encendida) -->
                <div id="marco-enfoque" class="hidden pointer-events-none absolute inset-6 border-2 border-emerald-400/50 rounded-2xl flex items-center justify-center">
                    <div class="w-16 h-0.5 bg-emerald-400 absolute top-1/2 -translate-y-1/2 animate-pulse shadow-md shadow-emerald-400"></div>
                    <div class="absolute bottom-3 bg-black/75 backdrop-blur-md px-3 py-1 rounded-full border border-white/10 flex items-center gap-1.5 shadow-lg">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        <span class="text-[10px] font-semibold text-white">Centra el código en el recuadro</span>
                    </div>
                </div>

            </div>

            <!-- Botón alternativo para subir foto -->
            <div class="mt-3 pt-2 border-t border-slate-800 flex justify-center">
                <input type="file" id="qr-input-file" accept="image/*" class="hidden" onchange="escanearDesdeArchivo(this)">

                <button type="button"
                        onclick="document.getElementById('qr-input-file').click()"
                        class="w-full py-2.5 px-4 rounded-xl bg-slate-900/90 hover:bg-slate-800 border border-slate-700 text-xs font-semibold text-slate-200 hover:text-white flex items-center justify-center gap-2 transition active:scale-95 shadow-sm">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Subir foto del código QR
                </button>
            </div>

        </div>

        <!-- Modo Demostración -->
        <div class="relative bg-gradient-to-br from-[#123829]/90 to-[#0c1f17]/95 border border-emerald-500/30 rounded-3xl p-4 shadow-xl overflow-hidden">
            <div class="absolute -right-5 -bottom-5 w-28 h-28 rounded-full overflow-hidden pointer-events-none select-none opacity-15 filter contrast-125">
                <img src="{{ asset('imagen/Logo_Ecovalor.jpg') }}" alt="Logo" class="w-full h-full object-contain mix-blend-screen">
            </div>

            <div class="relative z-10">
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-xs font-bold text-emerald-200 uppercase tracking-wider flex items-center gap-1.5">
                        <span>🧪</span> Modo Demostración
                    </span>
                    <span class="text-[10px] text-slate-400">Prueba directa</span>
                </div>

                <p class="text-[11px] text-slate-300 mb-2.5 leading-relaxed">
                    Si no tienes el código impreso, presiona uno de los puntos registrados:
                </p>

                <div class="flex flex-wrap gap-2">
                    @forelse($puntos ?? [] as $pto)
                        <a href="{{ route('entrega.formulario', $pto->codigo_qr) }}"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-white/10 hover:bg-emerald-500 hover:text-white border border-emerald-400/30 text-emerald-200 transition active:scale-95 shadow-sm">
                            <span class="text-[10px]">📍</span>
                            {{ $pto->codigo_qr }}
                            @if(!empty($pto->nombre))
                                <span class="text-[10px] font-normal opacity-75">({{ Str::limit($pto->nombre, 10) }})</span>
                            @endif
                        </a>
                    @empty
                        <span class="text-xs text-slate-400">No hay códigos registrados aún.</span>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    let html5QrCode = null;

    function onScanSuccess(decodedText) {
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                window.location.href = "/entrega/registrar/" + decodedText;
            }).catch(() => {
                window.location.href = "/entrega/registrar/" + decodedText;
            });
        } else {
            window.location.href = "/entrega/registrar/" + decodedText;
        }
    }

    // El usuario inicia la cámara con su clic
    function solicitarPermisoYActivarCamara() {
        const btn = document.getElementById('btn-activar');
        btn.disabled = true;
        btn.textContent = "Conectando cámara...";

        if (!html5QrCode) {
            html5QrCode = new Html5Qrcode("reader");
        }

        const config = { fps: 10, qrbox: { width: 220, height: 220 } };

        html5QrCode.start(
            { facingMode: "environment" },
            config,
            onScanSuccess
        ).then(() => {
            // Permiso concedido: ocultar tarjeta y mostrar cámara con marco
            document.getElementById('pantalla-permiso').classList.add('hidden');
            document.getElementById('reader').classList.remove('hidden');
            document.getElementById('marco-enfoque').classList.remove('hidden');
            document.getElementById('indicacion-texto').textContent = "Apunta al código QR dentro del recuadro verde";
        }).catch(err => {
            console.error("Permiso denegado o error de cámara:", err);
            btn.disabled = false;
            btn.textContent = "Reintentar Activar Cámara";
            alert("No se pudo acceder a la cámara. Revisa que hayas concedido el permiso en tu navegador o sube una foto con el botón inferior.");
        });
    }

    function escanearDesdeArchivo(input) {
        if (!input.files || input.files.length === 0) return;
        const imageFile = input.files[0];

        if (!html5QrCode) {
            html5QrCode = new Html5Qrcode("reader");
        }

        html5QrCode.scanFile(imageFile, true)
            .then(decodedText => {
                onScanSuccess(decodedText);
            })
            .catch(err => {
                alert("No se encontró ningún código QR legible en la imagen. Intenta con una foto más clara.");
            });
    }
</script>
@endpush

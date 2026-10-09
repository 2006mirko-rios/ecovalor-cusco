@extends('layouts.app')

@section('title', 'Puntos de Acopio - EcoValor')

@section('content')
<div class="relative min-h-screen overflow-hidden bg-slate-950 px-4 py-5 text-white">

    {{-- Fondo de entorno ambiental --}}
    <div class="pointer-events-none absolute inset-0">
        <img
            src="{{ asset('imagen/entorno.png') }}"
            alt=""
            class="h-full w-full object-cover opacity-40"
            onerror="this.onerror=null; this.src='{{ asset('images/entorno.png') }}';"
        >
        <div class="absolute inset-0 bg-slate-950/70"></div>
    </div>

    <main class="relative z-10 mx-auto w-full max-w-sm space-y-4">

        {{-- Encabezado --}}
        <header class="flex items-center justify-between">
            <a href="{{ route('home') }}"
               class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-slate-900/80 text-slate-200 transition hover:bg-slate-800"
               aria-label="Volver al inicio">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>

            <div class="text-center">
                <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-emerald-400">Cusco Limpio</p>
                <h1 class="text-base font-bold text-white">Puntos de Acopio</h1>
            </div>

            <a href="{{ route('entrega.escanear') }}"
               class="flex h-10 w-10 items-center justify-center rounded-xl border border-emerald-500/30 bg-emerald-500/15 text-emerald-300 transition hover:bg-emerald-500/25"
               title="Escanear QR">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                </svg>
            </a>
        </header>

        {{-- Mapa visual integrado (OpenStreetMap interactivo en el celular) --}}
        <div class="relative overflow-hidden rounded-3xl border border-emerald-500/30 bg-slate-900 shadow-xl">
            <div id="map" class="h-56 w-full z-0"></div>

            <div class="absolute bottom-2 left-2 right-2 flex items-center justify-between rounded-xl bg-slate-950/85 px-3 py-1.5 backdrop-blur-sm border border-white/10 text-[11px] text-slate-300">
                <span class="flex items-center gap-1.5">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-ping"></span>
                    Cusco, Perú
                </span>
                <span class="text-emerald-400 font-semibold" id="contador-puntos">Puntos activos</span>
            </div>
        </div>

        {{-- Lista de Puntos con acceso a Google Maps --}}
        <section class="space-y-3">
            <div class="flex items-center justify-between">
                <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400">Ubicaciones Disponibles</h2>
                <span class="text-[10px] text-emerald-400">Toca para navegar</span>
            </div>

            @php
                // Si la BD aún está vacía, usamos puntos reales de referencia en Cusco:
                $listaPuntos = (isset($puntos) && count($puntos) > 0) ? $puntos : collect([
                    (object)[
                        'id' => 1,
                        'nombre' => 'Punto Verde Plaza San Francisco',
                        'direccion' => 'Plaza San Francisco s/n, Centro Histórico',
                        'distrito' => 'Cusco',
                        'lat' => -13.5186,
                        'lng' => -71.9818,
                        'materiales' => 'Plástico, Latas, Papel',
                        'horario' => '08:00 - 17:00'
                    ],
                    (object)[
                        'id' => 2,
                        'nombre' => 'Módulo Ecológico Túpac Amaru',
                        'direccion' => 'Plaza Túpac Amaru, Wanchaq',
                        'distrito' => 'Wanchaq',
                        'lat' => -13.5238,
                        'lng' => -71.9654,
                        'materiales' => 'Botellas PET, Vidrio, Cartón',
                        'horario' => '07:30 - 16:30'
                    ],
                    (object)[
                        'id' => 3,
                        'nombre' => 'Ecopunto San Jerónimo',
                        'direccion' => 'Av. de la Cultura km 10',
                        'distrito' => 'San Jerónimo',
                        'lat' => -13.5458,
                        'lng' => -71.8885,
                        'materiales' => 'Plásticos duros, Metal, Papel',
                        'horario' => '08:00 - 18:00'
                    ],
                ]);
            @endphp

            <div class="space-y-3 max-h-80 overflow-y-auto pr-1">
                @foreach($listaPuntos as $punto)
                    @php
                        $lat = $punto->lat ?? -13.5186;
                        $lng = $punto->lng ?? -71.9818;
                        // Enlace directo oficial para abrir Google Maps en app móvil o navegador:
                        $googleMapsUrl = "https://www.google.com/maps/dir/?api=1&destination={$lat},{$lng}";
                    @endphp

                    <article class="rounded-2xl border border-white/10 bg-slate-900/85 p-3.5 shadow-lg transition hover:border-emerald-500/40">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <span class="rounded bg-emerald-500/20 px-1.5 py-0.5 text-[9px] font-bold uppercase tracking-wide text-emerald-300">
                                    {{ $punto->distrito ?? 'Cusco' }}
                                </span>
                                <h3 class="mt-1 text-sm font-bold text-white">{{ $punto->nombre }}</h3>
                                <p class="text-xs text-slate-300 mt-0.5">{{ $punto->direccion }}</p>
                            </div>
                            <span class="text-xl">📍</span>
                        </div>

                        <div class="mt-2.5 flex items-center justify-between border-t border-white/10 pt-2 text-[11px]">
                            <span class="text-slate-400">
                                🕒 {{ $punto->horario ?? 'Lun a Sáb' }}
                            </span>

                            {{-- Botón para abrir directamente en Google Maps --}}
                            <a href="{{ $googleMapsUrl }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-600 px-3 py-1.5 font-bold text-white shadow-md shadow-emerald-950/60 transition hover:bg-emerald-500 active:scale-95">
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/>
                                </svg>
                                Google Maps
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

    </main>
</div>

{{-- Leaflet CSS y JS para el mapa embebido interactivo --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Coordenadas del centro de Cusco
        const map = L.map('map').setView([-13.5238, -71.9700], 13);

        // Capa de mapa clara/limpia
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        const puntos = @json($listaPuntos);

        puntos.forEach(p => {
            const lat = p.lat || -13.5186;
            const lng = p.lng || -71.9818;
            const gUrl = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;

            const marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup(`
                <div style="font-size: 12px; color: #0f172a;">
                    <strong>${p.nombre}</strong><br>
                    ${p.direccion}<br>
                    <a href="${gUrl}" target="_blank" style="color: #059669; font-weight: bold; text-decoration: underline; margin-top: 4px; display: inline-block;">
                        Abrir en Google Maps &rarr;
                    </a>
                </div>
            `);
        });

        document.getElementById('contador-puntos').innerText = `${puntos.length} puntos`;
    });
</script>
@endsection

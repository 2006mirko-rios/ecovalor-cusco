@extends('layouts.app')

@section('title', 'Beneficios - EcoValor')

@section('content')
@php
    $puntosUsuario = $user->puntos_disponibles ?? 0;
@endphp

<div class="relative min-h-screen overflow-hidden bg-slate-950 px-4 py-6 text-white">

    {{-- Fondo de entorno ambiental con velo oscuro --}}
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <img
            src="{{ asset('imagen/entorno.jpg') }}"
            alt="Fondo Cusco"
            class="h-full w-full object-cover opacity-80 filter saturate-125"
        >
        <div class="absolute inset-0 bg-slate-950/75"></div>
    </div>

    <main class="relative z-10 mx-auto w-full max-w-md space-y-5">

        {{-- Encabezado con mini logo --}}
        <header class="flex items-center justify-between">
            <a href="{{ route('home') }}"
               class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-slate-900/80 text-slate-200 transition hover:bg-slate-800 active:scale-95 shadow"
               aria-label="Volver al inicio">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>

            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-white/95 p-0.5 shadow-sm overflow-hidden flex items-center justify-center border border-emerald-400/40">
                    <img src="{{ asset('imagen/Logo.png') }}" alt="Logo" class="w-full h-full object-contain rounded-full">
                </div>
                <div class="text-left">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-emerald-300 leading-tight">
                        EcoValor
                    </p>
                    <h1 class="text-base font-bold text-white leading-tight">Beneficios</h1>
                </div>
            </div>

            <a href="{{ route('puntos.index') }}"
               class="rounded-xl border border-emerald-400/30 bg-emerald-500/15 px-3 py-1.5 text-right transition hover:bg-emerald-500/25 active:scale-95 shadow-sm">
                <span class="block text-[10px] text-emerald-200">Tus puntos</span>
                <span class="text-xs font-bold text-white">
                    {{ number_format($puntosUsuario) }} pts
                </span>
            </a>
        </header>

        {{-- Mensajes de alerta --}}
        @if(session('success'))
            <div class="rounded-xl border border-emerald-400/30 bg-emerald-500/15 p-3 text-sm text-emerald-100">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-xl border border-amber-400/30 bg-amber-500/15 p-3 text-sm text-amber-100">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tarjeta Principal con MARCA DE AGUA DEL LOGO --}}
        <section class="relative overflow-hidden rounded-3xl border border-emerald-400/25 bg-gradient-to-br from-emerald-800 via-emerald-700 to-teal-900 p-5 shadow-xl shadow-emerald-950/60">

            <!-- Marca de agua transparente del logo EcoValor -->
            <div class="absolute -right-4 -bottom-4 w-36 h-36 rounded-full overflow-hidden pointer-events-none select-none opacity-20 filter contrast-125">
                <img src="{{ asset('imagen/Logo_Ecovalor.jpg') }}"
                     alt="Marca de agua"
                     class="w-full h-full object-contain mix-blend-screen">
            </div>

            <div class="relative z-10 flex items-start justify-between gap-3">
                <div>
                    <p class="text-sm font-semibold text-emerald-100">Tu esfuerzo se convierte en beneficios</p>
                    <p class="mt-1 text-xs leading-relaxed text-emerald-50/80">
                        Elige una recompensa y revisa cuántos EcoPuntos necesitas para canjearla.
                    </p>
                </div>
                <span class="text-3xl shrink-0" aria-hidden="true">🎁</span>
            </div>

            <div class="relative z-10 mt-4">
                <a href="{{ route('entrega.escanear') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-xs font-bold text-emerald-800 transition hover:bg-emerald-50 active:scale-95 shadow-md">
                    <span aria-hidden="true">♻</span>
                    Reciclar y ganar puntos
                </a>
            </div>
        </section>

        {{-- Catálogo de Beneficios --}}
        <section>
            <div class="mb-3 flex items-end justify-between">
                <div>
                    <h2 class="text-base font-bold">Recompensas disponibles</h2>
                    <p class="text-xs text-slate-300">Toca una tarjeta para ver sus detalles.</p>
                </div>
                <span class="rounded-full bg-white/10 px-2.5 py-1 text-[11px] text-slate-200">
                    {{ $beneficios->count() }} disponibles
                </span>
            </div>

            <div class="space-y-3">
                @forelse($beneficios as $beneficio)
                    @php
                        $puntosRequeridos = $beneficio->puntos_requeridos ?? $beneficio->puntos ?? 0;
                        $leAlcanza = $puntosUsuario >= $puntosRequeridos;
                        $faltan = max(0, $puntosRequeridos - $puntosUsuario);
                    @endphp

                    <article class="overflow-hidden rounded-2xl border border-white/10 bg-slate-900/85 shadow-lg">
                        <div class="flex gap-3 p-3.5">

                            {{-- Imagen o logotipo de respaldo --}}
                            <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-white/10 bg-emerald-950/70 p-1">
                                @if($beneficio->imagen)
                                    <img
                                        src="{{ asset('storage/' . $beneficio->imagen) }}"
                                        alt="{{ $beneficio->nombre }}"
                                        class="h-full w-full object-cover rounded-lg"
                                    >
                                @else
                                    <img
                                        src="{{ asset('imagen/Logo_Ecovalor.jpg') }}"
                                        alt="EcoValor"
                                        class="h-10 w-10 object-contain opacity-60"
                                    >
                                @endif
                            </div>

                            {{-- Información del beneficio --}}
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-[10px] font-semibold uppercase tracking-wide text-emerald-300">
                                    {{ $beneficio->comercio_aliado ?? 'Beneficio EcoValor' }}
                                </p>

                                <h3 class="mt-1 text-sm font-bold leading-snug text-white">
                                    {{ $beneficio->nombre }}
                                </h3>

                                <p class="mt-1 line-clamp-2 text-xs leading-relaxed text-slate-300">
                                    {{ $beneficio->descripcion ?? 'Consulta los detalles de esta recompensa.' }}
                                </p>
                            </div>
                        </div>

                        {{-- Precio y botón de acción --}}
                        <div class="flex items-center justify-between gap-3 border-t border-white/10 px-3.5 py-3">
                            <div>
                                <span class="block text-[10px] text-slate-400">Necesitas</span>
                                <span class="text-sm font-extrabold text-emerald-300">
                                    {{ number_format($puntosRequeridos) }} pts
                                </span>
                                @if(!$leAlcanza)
                                    <span class="ml-1 text-[10px] text-slate-400">
                                        · faltan {{ number_format($faltan) }}
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('beneficios.show', $beneficio->id) }}"
                               class="shrink-0 rounded-xl px-3.5 py-2 text-xs font-bold transition active:scale-95
                               {{ $leAlcanza
                                   ? 'bg-emerald-500 text-white hover:bg-emerald-400 shadow-md shadow-emerald-950/40'
                                   : 'border border-white/15 bg-white/5 text-slate-200 hover:bg-white/10' }}">
                                {{ $leAlcanza ? 'Ver y canjear' : 'Ver detalle' }}
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="rounded-2xl border border-dashed border-white/20 bg-slate-900/75 px-5 py-8 text-center">
                        <span class="text-4xl" aria-hidden="true">🌱</span>
                        <h3 class="mt-3 text-sm font-bold">Aún no hay beneficios disponibles</h3>
                        <p class="mx-auto mt-1 max-w-xs text-xs leading-relaxed text-slate-300">
                            Cuando se publiquen nuevas recompensas, aparecerán aquí.
                        </p>
                    </div>
                @endforelse
            </div>
        </section>

    </main>
</div>
@endsection

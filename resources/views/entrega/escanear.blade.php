@extends('layouts.app')
@section('title', 'Escanear QR de Acopio')

@section('content')
<div class="p-6">
    <div class="text-center mb-6">
        <h2 class="text-lg font-bold text-slate-800">Escanear Punto de Acopio</h2>
        <p class="text-xs text-slate-500">Apunta con la cámara al código QR del contenedor</p>
    </div>

    <!-- Visor de la Cámara -->
    <div class="bg-black rounded-2xl overflow-hidden aspect-square flex flex-col items-center justify-center relative border-4 border-emerald-600 shadow-inner">
        <div id="reader" class="w-full h-full"></div>
        <p class="text-white text-xs mt-2 absolute bottom-4 bg-black/60 px-3 py-1 rounded-full">
            Coloca el QR al centro del marco
        </p>
    </div>

    <!-- Alternativa Manual para Pruebas / Demostración -->
    <div class="mt-6 bg-white p-4 rounded-xl border border-slate-200">
        <p class="text-xs font-semibold text-slate-700 mb-2">O ingresa un código de prueba:</p>
        <div class="flex flex-wrap gap-2">
            @foreach($puntos as $pto)
                <a href="{{ route('entrega.formulario', $pto->codigo_qr) }}"
                   class="text-[11px] bg-slate-100 hover:bg-emerald-50 hover:text-emerald-700 border border-slate-300 px-2 py-1 rounded">
                   {{ $pto->codigo_qr }}
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    function onScanSuccess(decodedText) {
        window.location.href = "/entrega/registrar/" + decodedText;
    }
    let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 200 });
    html5QrcodeScanner.render(onScanSuccess);
</script>
@endpush

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'EcoValor Cusco')</title>
    <meta name="description" content="EcoValor Cusco: app de reciclaje y recompensas en Cusco. Descarga la APK para Android.">

    <!-- Configuración PWA (Instalable en Celular y PC) -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0d1d17">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="EcoValor">
    <link rel="icon" type="image/png" href="/imagen/icon-192.png">
    <link rel="apple-touch-icon" href="/imagen/icon-512.png">

    <!-- Tailwind CSS CDN para renderizado inmediato -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-950 min-h-screen flex items-center justify-center p-0 sm:p-4">

    <!-- Marco de Teléfono Móvil a pantalla completa -->
    <main class="w-full max-w-sm h-screen sm:h-[92vh] sm:max-h-[820px] bg-[#0d1d17] sm:rounded-[36px] shadow-2xl overflow-y-auto relative border-0 sm:border-4 sm:border-emerald-950 flex flex-col">
        @yield('content')
    </main>

    @stack('scripts')

    <!-- Registro del Service Worker de la PWA -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then((reg) => console.log('PWA lista - EcoValor Cusco:', reg.scope))
                    .catch((err) => console.warn('Aviso Service Worker:', err));
            });
        }
    </script>
</body>
</html>

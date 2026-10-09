<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\BeneficioController;
use App\Http\Controllers\PerfilController;

// Pantalla de Bienvenida / Splash inicial
Route::get('/', function () {
    return view('welcome');
})->name('splash');

// Rutas de Invitados (Registro e Inicio de Sesión)
Route::middleware('guest')->group(function () {
    Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registro', [AuthController::class, 'register'])->name('register.submit');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Rutas Protegidas del Ciudadano (Requiere Inicio de Sesión)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Pantalla Principal y Puntos
    Route::get('/inicio', [HomeController::class, 'index'])->name('home');
    Route::get('/mis-puntos', [HomeController::class, 'puntos'])->name('puntos.index');

    // Mapa de Puntos de Acopio
    Route::get('/mapa', [MapaController::class, 'index'])->name('mapa.index');

    // Escáner QR y Registro de Entregas
    Route::get('/escanear', [EntregaController::class, 'escanear'])->name('entrega.escanear');
    Route::get('/entrega/registrar/{codigo}', [EntregaController::class, 'formRegistro'])->name('entrega.formulario');
    Route::post('/entrega/guardar', [EntregaController::class, 'guardar'])->name('entrega.guardar');
    Route::get('/historial', [EntregaController::class, 'historial'])->name('entrega.historial');

    // Catálogo de Beneficios y Canjes
    Route::get('/beneficios', [BeneficioController::class, 'index'])->name('beneficios.index');
    Route::get('/beneficios/{id}', [BeneficioController::class, 'show'])->name('beneficios.show');
    Route::post('/beneficios/{id}/canjear', [BeneficioController::class, 'canjear'])->name('beneficios.canjear');

    // Perfil y Configuraciones
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::post('/perfil/actualizar', [PerfilController::class, 'actualizar'])->name('perfil.actualizar');
});


Route::get('/', function () {
    return view('descargar');
});

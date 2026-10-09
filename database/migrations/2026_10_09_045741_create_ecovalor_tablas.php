<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Puntos de Acopio en Cusco
        Schema::create('puntos_acopio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo_qr')->unique();
            $table->string('direccion');
            $table->string('distrito');
            $table->decimal('latitud', 10, 7);
            $table->decimal('longitud', 10, 7);
            $table->string('horario')->default('Lunes a Sábado: 8:00 AM - 5:00 PM');
            $table->string('tipo_materiales')->default('Plástico, Papel, Cartón, Vidrio, Metal');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        // 2. Historial de Entregas de Residuos
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('punto_acopio_id')->constrained('puntos_acopio')->cascadeOnDelete();
            $table->string('material');
            $table->decimal('peso_kg', 8, 2);
            $table->integer('puntos_ganados');
            $table->timestamps();
        });

        // 3. Catálogo de Beneficios y Recompensas
        Schema::create('beneficios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('aliado');
            $table->integer('puntos_requeridos');
            $table->string('icono')->default('bi-gift');
            $table->date('vigencia')->nullable();
            $table->integer('stock')->default(50);
            $table->timestamps();
        });

        // 4. Registro de Canjes Realizados
        Schema::create('canjes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('beneficio_id')->constrained()->cascadeOnDelete();
            $table->integer('puntos_utilizados');
            $table->string('codigo_cupon')->unique();
            $table->enum('estado', ['activo', 'usado', 'vencido'])->default('activo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('canjes');
        Schema::dropIfExists('beneficios');
        Schema::dropIfExists('entregas');
        Schema::dropIfExists('puntos_acopio');
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    protected $fillable = ['user_id', 'punto_acopio_id', 'material', 'peso_kg', 'puntos_ganados'];

    // Puntos otorgados por cada kilogramo de residuo
    public const FACTORES_PUNTOS = [
        'Plástico PET'   => 20,
        'Papel y Cartón' => 15,
        'Vidrio'         => 10,
        'Latas de Metal' => 30,
        'Chatarra Electrónica' => 50,
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function puntoAcopio() {
        return $this->belongsTo(PuntoAcopio::class);
    }

    public static function calcularPuntos(string $material, float $peso): int {
        $factor = self::FACTORES_PUNTOS[$material] ?? 10;
        return (int) round($peso * $factor);
    }
}

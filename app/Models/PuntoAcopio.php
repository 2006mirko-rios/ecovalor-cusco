<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntoAcopio extends Model
{
    protected $table = 'puntos_acopio';
    protected $fillable = ['nombre', 'codigo_qr', 'direccion', 'distrito', 'latitud', 'longitud', 'horario', 'tipo_materiales', 'activo'];

    public function entregas() {
        return $this->hasMany(Entrega::class);
    }
}

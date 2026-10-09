<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'aliado', 'puntos_requeridos', 'icono', 'vigencia', 'stock'];

    public function canjes() {
        return $this->hasMany(Canje::class);
    }
}

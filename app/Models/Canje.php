<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Canje extends Model
{
    protected $fillable = ['user_id', 'beneficio_id', 'puntos_utilizados', 'codigo_cupon', 'estado'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function beneficio() {
        return $this->belongsTo(Beneficio::class);
    }
}

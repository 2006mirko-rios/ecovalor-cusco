<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'dni', 'email', 'telefono', 'distrito', 'password', 'puntos_acumulados', 'puntos_canjeados',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function entregas() {
        return $this->hasMany(Entrega::class)->latest();
    }

    public function canjes() {
        return $this->hasMany(Canje::class)->latest();
    }

    public function getPuntosDisponiblesAttribute() {
        return max(0, $this->puntos_acumulados - $this->puntos_canjeados);
    }

    public function getNivelAttribute() {
        return $this->puntos_acumulados >= 500 ? 'EcoLíder' : 'Guardián Verde';
    }

    public function getProgresoNivelAttribute() {
        return min(100, round(($this->puntos_acumulados / 500) * 100));
    }
}

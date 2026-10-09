<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PuntoAcopio;
use App\Models\Beneficio;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Usuario Ciudadano de prueba
        User::create([
            'name'              => 'Juan Carlos Pérez Quispe',
            'dni'               => '70334455',
            'email'             => 'juan.perez@ecovalor.pe',
            'telefono'          => '984123456',
            'distrito'          => 'Wanchaq',
            'password'          => Hash::make('password'),
            'puntos_acumulados' => 280,
            'puntos_canjeados'  => 0,
        ]);

        // 2. Puntos de Acopio en Cusco
        PuntoAcopio::create([
            'nombre'         => 'Punto Verde San Blas',
            'codigo_qr'      => 'ACOPIO-SANBLAS',
            'direccion'      => 'Plazoleta San Blas s/n',
            'distrito'       => 'Cusco Histórico',
            'latitud'        => -13.5152,
            'longitud'       => -71.9754,
            'horario'        => 'Lun a Sáb: 8:00 AM - 5:00 PM',
            'tipo_materiales'=> 'Plástico PET, Papel y Cartón, Vidrio',
        ]);

        PuntoAcopio::create([
            'nombre'         => 'EcoMódulo Wanchaq',
            'codigo_qr'      => 'ACOPIO-WANCHAQ',
            'direccion'      => 'Av. de la Cultura 820',
            'distrito'       => 'Wanchaq',
            'latitud'        => -13.5228,
            'longitud'       => -71.9575,
            'horario'        => 'Lun a Dom: 7:00 AM - 6:00 PM',
            'tipo_materiales'=> 'Plástico PET, Latas de Metal, Cartón',
        ]);

        PuntoAcopio::create([
            'nombre'         => 'Punto Limpio San Sebastián',
            'codigo_qr'      => 'ACOPIO-SANSEBASTIAN',
            'direccion'      => 'Plaza Principal San Sebastián',
            'distrito'       => 'San Sebastián',
            'latitud'        => -13.5312,
            'longitud'       => -71.9284,
            'horario'        => 'Lun a Vie: 8:00 AM - 4:00 PM',
            'tipo_materiales'=> 'Vidrio, Plástico, Chatarra Electrónica',
        ]);

        // 3. Catálogo de Beneficios
        Beneficio::create([
            'titulo'            => 'Boleto de Pasaje Urbano (Cusco)',
            'descripcion'       => 'Vale digital canjeable por 2 pasajes en rutas de transporte autorizadas de Cusco.',
            'aliado'            => 'Consorcio Urbano Cusco',
            'puntos_requeridos' => 100,
            'icono'             => 'bi-bus-front',
            'stock'             => 40,
        ]);

        Beneficio::create([
            'titulo'            => '20% Dscto. en Productos Agroecológicos',
            'descripcion'       => 'Válido en las ferias sabatinas de Huancaro para frutas y verduras orgánicas.',
            'aliado'            => 'Feria Huancaro Verde',
            'puntos_requeridos' => 150,
            'icono'             => 'bi-basket2',
            'stock'             => 25,
        ]);

        Beneficio::create([
            'titulo'            => 'Entrada Cultural Qorikancha',
            'descripcion'       => 'Acceso libre para un ciudadano al museo de sitio de Qorikancha.',
            'aliado'            => 'Dirección Desconcentrada de Cultura',
            'puntos_requeridos' => 300,
            'icono'             => 'bi-ticket-perforated',
            'stock'             => 15,
        ]);
    }
}

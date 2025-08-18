<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PlaceType;

class PlaceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $placeTypes = [
            [
                'name' => 'Restaurante',
                'description' => 'Lugares para comer y disfrutar de buena comida'
            ],
            [
                'name' => 'Bar/Pub',
                'description' => 'Lugares para tomar bebidas y socializar'
            ],
            [
                'name' => 'Café',
                'description' => 'Cafeterías y lugares para tomar café'
            ],
            [
                'name' => 'Gimnasio',
                'description' => 'Centros de ejercicio y fitness'
            ],
            [
                'name' => 'Parque',
                'description' => 'Espacios verdes y áreas recreativas'
            ],
            [
                'name' => 'Museo',
                'description' => 'Espacios culturales y de arte'
            ],
            [
                'name' => 'Cine',
                'description' => 'Salas de proyección cinematográfica'
            ],
            [
                'name' => 'Teatro',
                'description' => 'Espacios para artes escénicas'
            ],
            [
                'name' => 'Centro Comercial',
                'description' => 'Lugares de compras y entretenimiento'
            ],
            [
                'name' => 'Playa',
                'description' => 'Zonas costeras y balnearios'
            ],
            [
                'name' => 'Discoteca',
                'description' => 'Lugares de entretenimiento nocturno'
            ],
            [
                'name' => 'Biblioteca',
                'description' => 'Espacios de estudio y lectura'
            ],
            [
                'name' => 'Spa',
                'description' => 'Centros de relajación y bienestar'
            ],
            [
                'name' => 'Hotel',
                'description' => 'Lugares de hospedaje'
            ],
            [
                'name' => 'Centro de Entretenimiento',
                'description' => 'Lugares de diversión y juegos'
            ],
            [
                'name' => 'Galería de Arte',
                'description' => 'Espacios de exposición artística'
            ],
            [
                'name' => 'Centro Deportivo',
                'description' => 'Instalaciones para diversos deportes'
            ],
            [
                'name' => 'Mercado',
                'description' => 'Lugares de venta de productos locales'
            ],
            [
                'name' => 'Mirador',
                'description' => 'Puntos de observación panorámica'
            ],
            [
                'name' => 'Otro',
                'description' => 'Otros tipos de lugares no categorizados'
            ]
        ];

        foreach ($placeTypes as $placeType) {
            PlaceType::firstOrCreate(['name' => $placeType['name']], $placeType);
        }
    }
}

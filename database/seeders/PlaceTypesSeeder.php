<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PlaceType;

class PlaceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $placeTypes = [
            ['name' => 'Restaurante', 'description' => 'Lugares para comer y cenar'],
            ['name' => 'Bar', 'description' => 'Bares y cantinas'],
            ['name' => 'Cafetería', 'description' => 'Cafés y lugares de bebidas'],
            ['name' => 'Discoteca', 'description' => 'Lugares de baile y vida nocturna'],
            ['name' => 'Parque', 'description' => 'Parques y áreas verdes'],
            ['name' => 'Playa', 'description' => 'Playas y zonas costeras'],
            ['name' => 'Museo', 'description' => 'Museos y centros culturales'],
            ['name' => 'Centro Comercial', 'description' => 'Centros comerciales y tiendas'],
            ['name' => 'Gimnasio', 'description' => 'Gimnasios y centros deportivos'],
            ['name' => 'Hotel', 'description' => 'Hoteles y hospedajes'],
            ['name' => 'Spa', 'description' => 'Spas y centros de bienestar'],
            ['name' => 'Teatro', 'description' => 'Teatros y centros de espectáculos'],
            ['name' => 'Cine', 'description' => 'Cines y salas de proyección'],
            ['name' => 'Mercado', 'description' => 'Mercados y ferias'],
            ['name' => 'Mirador', 'description' => 'Miradores y puntos escénicos'],
        ];

        foreach ($placeTypes as $placeType) {
            PlaceType::create($placeType);
        }

        $this->command->info('Place types created successfully!');
    }
}

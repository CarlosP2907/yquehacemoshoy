<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Interest;

class InterestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interests = [
            ['name' => 'Gastronomía', 'description' => 'Restaurantes, cafeterías, comida típica'],
            ['name' => 'Vida Nocturna', 'description' => 'Bares, discotecas, entretenimiento nocturno'],
            ['name' => 'Naturaleza', 'description' => 'Parques, playas, montañas, actividades al aire libre'],
            ['name' => 'Cultura', 'description' => 'Museos, galerías, teatro, eventos culturales'],
            ['name' => 'Deportes', 'description' => 'Gimnasios, deportes extremos, actividades físicas'],
            ['name' => 'Compras', 'description' => 'Centros comerciales, mercados, tiendas'],
            ['name' => 'Familia', 'description' => 'Actividades familiares, parques infantiles'],
            ['name' => 'Turismo', 'description' => 'Sitios turísticos, tours, atracciones'],
            ['name' => 'Relax', 'description' => 'Spas, lugares tranquilos, meditación'],
            ['name' => 'Aventura', 'description' => 'Deportes extremos, aventuras, adrenalina'],
            ['name' => 'Arte', 'description' => 'Galerías, exposiciones, arte callejero'],
            ['name' => 'Música', 'description' => 'Conciertos, eventos musicales, karaoke'],
            ['name' => 'Tecnología', 'description' => 'Eventos tech, espacios de coworking'],
            ['name' => 'Educación', 'description' => 'Talleres, cursos, bibliotecas'],
            ['name' => 'Salud', 'description' => 'Centros de salud, yoga, bienestar'],
        ];

        foreach ($interests as $interest) {
            Interest::create($interest);
        }

        $this->command->info('Interests created successfully!');
    }
}

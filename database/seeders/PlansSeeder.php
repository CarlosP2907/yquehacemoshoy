<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            // Planes para usuarios
            [
                'name' => 'Usuario Gratuito',
                'type' => 'user',
                'price' => 0.00,
                'allowed_posts' => 0,
                'description' => 'Plan básico gratuito para usuarios. Permite ver lugares y comentar.'
            ],
            [
                'name' => 'Usuario Premium',
                'type' => 'user',
                'price' => 9.99,
                'allowed_posts' => 0,
                'description' => 'Plan premium para usuarios. Incluye filtros avanzados, soporte prioritario y funciones exclusivas.'
            ],

            // Planes para empresas
            [
                'name' => 'Empresa Gratuito',
                'type' => 'company',
                'price' => 0.00,
                'allowed_posts' => 1,
                'description' => 'Plan gratuito para empresas. Permite 1 publicación por mes.'
            ],
            [
                'name' => 'Plan Comercio',
                'type' => 'company',
                'price' => 29.99,
                'allowed_posts' => 5,
                'description' => 'Plan comercial para pequeñas empresas. Permite 5 publicaciones por mes.'
            ],
            [
                'name' => 'Plan Empresarial',
                'type' => 'company',
                'price' => 79.99,
                'allowed_posts' => 10,
                'description' => 'Plan empresarial para grandes empresas. Permite 10 publicaciones por mes y analytics avanzados.'
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }

        $this->command->info('Plans created successfully!');
    }
}

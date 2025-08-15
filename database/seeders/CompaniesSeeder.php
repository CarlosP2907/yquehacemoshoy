<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Support\Facades\Hash;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Restaurante Típico Ticos',
                'email' => 'info@ticos.cr',
                'plan' => 'free',
                'description' => 'El mejor restaurante de comida típica costarricense en San José',
                'location' => 'San José Centro, Costa Rica',
                'website' => 'https://ticos.cr',
                'phone' => '+506 2222-3333',
                'verified' => true,
            ],
            [
                'name' => 'Aventuras Costa Rica',
                'email' => 'tours@aventuras.cr',
                'plan' => 'business',
                'description' => 'Tours de aventura y deportes extremos por todo Costa Rica',
                'location' => 'Manuel Antonio, Costa Rica',
                'website' => 'https://aventuras.cr',
                'phone' => '+506 2777-8888',
                'verified' => true,
            ],
            [
                'name' => 'Hotel Boutique Pura Vida',
                'email' => 'reservas@puravida.cr',
                'plan' => 'enterprise',
                'description' => 'Hotel boutique de lujo en el corazón de Costa Rica',
                'location' => 'Monteverde, Costa Rica',
                'website' => 'https://puravida.cr',
                'phone' => '+506 2645-7777',
                'verified' => true,
            ],
            [
                'name' => 'Café Central',
                'email' => 'hola@cafecentral.cr',
                'plan' => 'free',
                'description' => 'Café artesanal con los mejores granos de Costa Rica',
                'location' => 'Cartago, Costa Rica',
                'website' => 'https://cafecentral.cr',
                'phone' => '+506 2591-4444',
                'verified' => false,
            ],
            [
                'name' => 'Surf Paradise',
                'email' => 'info@surfparadise.cr',
                'plan' => 'business',
                'description' => 'Escuela de surf y alquiler de equipos en las mejores playas',
                'location' => 'Tamarindo, Guanacaste',
                'website' => 'https://surfparadise.cr',
                'phone' => '+506 2653-9999',
                'verified' => true,
            ],
        ];

        foreach ($companies as $companyData) {
            $planName = $companyData['plan'];
            unset($companyData['plan']);

            $company = Company::create(array_merge($companyData, [
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]));

            $company->assignRole('company');

            // Asignar suscripción según el plan
            $planMap = [
                'free' => 'Empresa Gratuito',
                'business' => 'Plan Comercio',
                'enterprise' => 'Plan Empresarial',
            ];

            $plan = Plan::where('name', $planMap[$planName])->first();
            if ($plan) {
                Subscription::create([
                    'company_id' => $company->id,
                    'plan_id' => $plan->id,
                    'start_date' => now(),
                    'end_date' => $plan->isFree() ? null : now()->addMonth(),
                    'status' => 'active',
                ]);
            }
        }

        $this->command->info('Companies created successfully!');
    }
}

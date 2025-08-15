<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Interest;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario administrador
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@yquehacemoshoy.com',
            'password' => Hash::make('password'),
            'type' => 'premium',
            'location' => 'San José, Costa Rica',
            'latitude' => '9.9341',
            'longitude' => '-84.0905',
            'phone' => '+506 1234-5678',
            'description' => 'Administrador del sistema',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Usuario normal de prueba
        $user1 = User::create([
            'name' => 'María González',
            'email' => 'maria@example.com',
            'password' => Hash::make('password'),
            'type' => 'free',
            'location' => 'San José, Costa Rica',
            'latitude' => '9.9342',
            'longitude' => '-84.0906',
            'phone' => '+506 8765-4321',
            'description' => 'Me encanta explorar nuevos lugares en Costa Rica',
            'email_verified_at' => now(),
        ]);
        $user1->assignRole('user');
        $user1->interests()->attach([1, 3, 8]); // Gastronomía, Naturaleza, Turismo

        // Usuario premium de prueba
        $user2 = User::create([
            'name' => 'Carlos Ramírez',
            'email' => 'carlos@example.com',
            'password' => Hash::make('password'),
            'type' => 'premium',
            'location' => 'Cartago, Costa Rica',
            'latitude' => '9.8644',
            'longitude' => '-83.9206',
            'phone' => '+506 2468-1357',
            'description' => 'Aventurero y amante de los deportes extremos',
            'email_verified_at' => now(),
        ]);
        $user2->assignRole('premium_user');
        $user2->interests()->attach([5, 10, 12]); // Deportes, Aventura, Música

        // Más usuarios de prueba
        $users = [
            [
                'name' => 'Ana Jiménez',
                'email' => 'ana@example.com',
                'location' => 'Alajuela, Costa Rica',
                'latitude' => '10.0162',
                'longitude' => '-84.2103',
                'interests' => [4, 11, 14] // Cultura, Arte, Educación
            ],
            [
                'name' => 'Luis Morales',
                'email' => 'luis@example.com',
                'location' => 'Puntarenas, Costa Rica',
                'latitude' => '9.9703',
                'longitude' => '-84.8372',
                'interests' => [2, 3, 7] // Vida Nocturna, Naturaleza, Familia
            ],
        ];

        foreach ($users as $userData) {
            $interests = $userData['interests'];
            unset($userData['interests']);
            
            $user = User::create(array_merge($userData, [
                'password' => Hash::make('password'),
                'type' => 'free',
                'phone' => '+506 ' . rand(1000, 9999) . '-' . rand(1000, 9999),
                'description' => 'Usuario de prueba',
                'email_verified_at' => now(),
            ]));
            
            $user->assignRole('user');
            $user->interests()->attach($interests);
        }

        $this->command->info('Users created successfully!');
    }
}

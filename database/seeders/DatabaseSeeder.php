<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            PlansSeeder::class,
            InterestsSeeder::class,
            PlaceTypesSeeder::class,
            UsersSeeder::class,
            CompaniesSeeder::class,
            // PlacesSeeder::class, // Lo agregaremos después
        ]);

        $this->command->info('🎉 Database seeded successfully!');
        $this->command->info('📧 Admin credentials: admin@yquehacemoshoy.com / password');
        $this->command->info('👤 Test user: maria@example.com / password');
        $this->command->info('🏢 Test company: info@ticos.cr / password');
    }
}

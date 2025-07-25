<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'admin' => true,
            'password' => Hash::make('admin123*'),
            'birthdate' => '1990-01-01',
            'about' => 'Admin',
        
        ]);


        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@ehb.be',
            'admin' => true,
            'password' => Hash::make('Password!321'),
            'birthdate' => '1990-01-01',
            'about' => 'Admin',


        
        ]);




        $this->call([
            FAQSeeder::class,
        ]);

        
    }
}

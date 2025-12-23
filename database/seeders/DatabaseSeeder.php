<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Formation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Formateur
        $formateur = User::create([
            'name' => 'Formateur John',
            'email' => 'formateur@example.com',
            'password' => Hash::make('password'),
            'role' => 'formateur',
        ]);

        // Create Etudiant
        User::create([
            'name' => 'Student Jane',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role' => 'etudiant',
        ]);

        // Create Formations
        Formation::create([
            'titre' => 'Laravel 12 for Beginners',
            'description' => 'Learn the basics of Laravel 12 framework.',
            'duree' => 20,
            'prix' => 49.99,
            'formateur_id' => $formateur->id,
        ]);

        Formation::create([
            'titre' => 'Advanced API Development',
            'description' => 'Master RESTful API development with Laravel.',
            'duree' => 30,
            'prix' => 79.99,
            'formateur_id' => $formateur->id,
        ]);
    }
}

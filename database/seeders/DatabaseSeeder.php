<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $categoryNames = [
            'Ours',
            'Oiseaux',
            'Marins',
            'Animaux des sous-bois',
            'Exotiques'
        ];

        foreach ($categoryNames as $name) {
            Category::create([
                'name' => $name,
            ]);
        }
    }
}

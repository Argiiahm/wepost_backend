<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Categories::create([
            "name" => "Coding",
        ]);
        Categories::create([
            "name" => "Healing",
        ]);
        Categories::create([
            "name" => "Film",
        ]);
        Categories::create([
            "name" => "Live",
        ]);
        Categories::create([
            "name" => "Football",
        ]);
        Categories::create([
            "name" => "Romance",
        ]);
    }
}

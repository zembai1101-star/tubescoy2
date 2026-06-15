<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // <-- INI DIA YANG KETINGGALAN CUY!

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Bikin satu user admin default dengan email baru
        User::create([
            'name' => 'Andriana Manurung',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'), 
        ]);
    }
}
<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@survey.com',
            'password' => \Hash::make('admin123'),
        ]);

        \App\Models\Setting::create(['key' => 'app_name', 'value' => 'Survey Kepuasan Masyarakat']);
        
        \App\Models\Survey::create(['nama' => 'Budi', 'skor' => 5, 'komentar' => 'Layanan sangat baik!']);
        \App\Models\Survey::create(['nama' => 'Siti', 'skor' => 4, 'komentar' => 'Cepat dan ramah.']);
        \App\Models\Survey::create(['nama' => 'Andi', 'skor' => 3, 'komentar' => 'Biasa saja.']);
    }
}

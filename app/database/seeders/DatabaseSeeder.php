<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Setting;
use App\Models\Survey;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@survey.com',
            'password' => Hash::make('admin123'),
        ]);

        Setting::create(['key' => 'app_name', 'value' => 'Survey Kepuasan Masyarakat']);
        Setting::create(['key' => 'app_description', 'value' => 'Sistem Informasi Survey Kepuasan Masyarakat Portabel']);
        Setting::create(['key' => 'contact_email', 'value' => 'info@instansi.go.id']);
        Setting::create(['key' => 'footer_text', 'value' => '© 2026 Instansi Layanan Publik']);
        
        $dummies = [
            ['nama' => 'Budi Santoso', 'q1' => 5, 'q2' => 4, 'q3' => 5, 'q4' => 4, 'q5' => 5, 'q6' => 4, 'q7' => 5, 'q8' => 4, 'q9' => 5, 'komentar' => 'Sangat membantu dan cepat!'],
            ['nama' => 'Siti Aminah', 'q1' => 4, 'q2' => 3, 'q3' => 4, 'q4' => 5, 'q5' => 4, 'q6' => 5, 'q7' => 4, 'q8' => 5, 'q9' => 4, 'komentar' => 'Prosedur mohon dipermudah lagi.'],
            ['nama' => 'Andi Wijaya', 'q1' => 3, 'q2' => 3, 'q3' => 3, 'q4' => 3, 'q5' => 3, 'q6' => 3, 'q7' => 3, 'q8' => 3, 'q9' => 3, 'komentar' => 'Biasa saja, standar.'],
        ];

        foreach ($dummies as $d) {
            $avg = ($d['q1'] + $d['q2'] + $d['q3'] + $d['q4'] + $d['q5'] + $d['q6'] + $d['q7'] + $d['q8'] + $d['q9']) / 9;
            $d['rata_rata'] = round($avg, 2);
            Survey::create($d);
        }
    }
}

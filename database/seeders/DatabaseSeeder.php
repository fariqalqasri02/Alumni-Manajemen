<?php

namespace Database\Seeders;

use App\Models\CareerEvent;
use App\Models\JobVacancy;
use App\Models\SystemNotification;
use App\Models\TracerStudy;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin Alumni',
            'email' => 'admin@alumni.test',
            'role' => 'admin',
            'user_type' => 'alumni',
            'nim' => 'ADM001',
            'password' => Hash::make('password'),
        ]);

        $user = User::factory()->create([
            'name' => 'User Alumni',
            'email' => 'user@alumni.test',
            'role' => 'user',
            'user_type' => 'alumni',
            'nim' => '202012345',
            'password' => Hash::make('password'),
        ]);

        UserProfile::create([
            'user_id' => $admin->id,
            'study_program' => 'Sistem Informasi',
            'graduation_year' => 2022,
            'skills' => 'Leadership, pelaporan, komunikasi',
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'study_program' => 'Teknik Informatika',
            'graduation_year' => 2024,
            'skills' => 'Laravel, PHP, MySQL',
        ]);

        JobVacancy::create([
            'title' => 'Backend Developer Laravel',
            'company' => 'PT Mitra Karier Digital',
            'location' => 'Jakarta',
            'employment_type' => 'full-time',
            'salary_min' => 6000000,
            'salary_max' => 9000000,
            'deadline' => now()->addDays(30),
            'is_published' => true,
            'description' => 'Membangun dan memelihara aplikasi web berbasis Laravel.',
            'requirements' => 'Menguasai PHP, Laravel, REST API, dan basis data relasional.',
            'application_link' => 'https://example.com/jobs/backend-laravel',
            'created_by' => $admin->id,
        ]);

        CareerEvent::create([
            'title' => 'Seminar Persiapan Karier 2026',
            'event_type' => 'Seminar',
            'location' => 'Aula Kampus',
            'start_at' => now()->addWeek(),
            'end_at' => now()->addWeek()->addHours(3),
            'quota' => 150,
            'is_published' => true,
            'description' => 'Seminar pengembangan karier untuk mahasiswa dan alumni.',
            'created_by' => $admin->id,
        ]);

        TracerStudy::create([
            'user_id' => $user->id,
            'employment_status' => 'bekerja',
            'company_name' => 'PT Solusi Digital',
            'job_title' => 'Junior Backend Developer',
            'relevance_level' => 4,
            'waiting_period_months' => 2,
            'salary' => 6500000,
            'feedback' => 'Kurikulum cukup relevan untuk kebutuhan kerja.',
            'survey_year' => now()->year,
        ]);

        SystemNotification::create([
            'title' => 'Selamat datang di portal alumni',
            'message' => 'Gunakan dashboard untuk melihat lowongan terbaru dan kegiatan karier.',
            'type' => 'system',
            'published_at' => now(),
        ]);
    }
}

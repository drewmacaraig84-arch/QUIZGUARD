<?php

namespace Database\Seeders;

use App\Models\User;
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
        // 1. Preset Admin Account (Active)
        User::firstOrCreate(
            ['dwcc_email' => 'johncarlo.tolentino@dwcc.edu.ph'],
            [
                'role' => 'admin',
                'school_id_num' => 47696,
                'first_name' => 'John Carlo',
                'last_name' => 'Tolentino',
                'password_hash' => Hash::make('password'),
                'department' => 'IT/Admin',
                'status' => 'active',
            ]
        );

        // 2. Sample Teacher Account (Active)
        User::firstOrCreate(
            ['dwcc_email' => 'angelica.reyes@dwcc.edu.ph'],
            [
                'role' => 'teacher',
                'school_id_num' => 20184,
                'first_name' => 'Angelica',
                'last_name' => 'Reyes',
                'password_hash' => Hash::make('password'),
                'department' => 'IT Department',
                'status' => 'active',
            ]
        );

        // 3. Sample Student Account (Active)
        User::firstOrCreate(
            ['dwcc_email' => 'sayo.boy@dwcc.edu.ph'],
            [
                'role' => 'student',
                'school_id_num' => 20230210,
                'first_name' => 'Sayo',
                'last_name' => 'Boy',
                'password_hash' => Hash::make('password'),
                'department' => 'CITE',
                'section' => 'BSIT 3A',
                'status' => 'active',
            ]
        );

        // 4. Sample Pending Account with Known OTP for Verification testing
        User::updateOrCreate(
            ['dwcc_email' => 'kevin.mendoza@dwcc.edu.ph'],
            [
                'role' => 'student',
                'school_id_num' => 20240101,
                'first_name' => 'Kevin',
                'last_name' => 'Mendoza',
                'password_hash' => Hash::make('password'),
                'department' => 'CITE',
                'section' => 'BSIT 1A',
                'status' => 'pending',
                'otp_hash' => Hash::make('123456'),
                'otp_expires_at' => now()->addDays(7), // Generous window for testing
                'otp_attempts' => 0,
            ]
        );
    }
}

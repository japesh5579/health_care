<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $doctorsData = [
            ['name' => 'Dr. Olivia Bennett', 'specialization' => 'Cardiologist'],
            ['name' => 'Dr. Marcus Webb', 'specialization' => 'Neurologist'],
            ['name' => 'Dr. Sophia Evans', 'specialization' => 'Pediatrician'],
            ['name' => 'Dr. Julian Foster', 'specialization' => 'General Surgeon'],
            ['name' => 'Dr. Emily Chen', 'specialization' => 'Dermatologist'],
        ];

        foreach ($doctorsData as $doc) {
            Doctor::create($doc);
        }

        // Create Demo Admin User for Portfolio
        \App\Models\User::create([
            'name' => 'Demo Admin',
            'email' => 'jhatta@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('jhatta12345'),
        ]);

        $patientsData = [
            ['name' => 'Sarah Connor', 'email' => 'sarah.c@example.com'],
            ['name' => 'John Smith', 'email' => 'john.s@example.com'],
            ['name' => 'David Martinez', 'email' => 'dmartinez@example.com'],
            ['name' => 'Amanda Lewis', 'email' => 'amanda.l@example.com'],
            ['name' => 'Michael Chang', 'email' => 'mchang@example.com'],
        ];

        foreach ($patientsData as $pat) {
            Patient::create($pat);
        }

        Appointment::create([
            'patient_id' => 1,
            'doctor_id' => 1,
            'appointment_date' => now()->addDays(2),
            'status' => 'pending'
        ]);

        $app2 = Appointment::create([
            'patient_id' => 2,
            'doctor_id' => 3,
            'appointment_date' => now()->subDays(5),
            'status' => 'completed'
        ]);

        MedicalRecord::create([
            'appointment_id' => $app2->id,
            'notes' => 'Patient reported mild fever and coughing. Prescribed a 5-day course of basic antibiotics. Chest X-Ray cleared.'
        ]);
        
        Appointment::create([
            'patient_id' => 3,
            'doctor_id' => 2,
            'appointment_date' => now()->addDays(10),
            'status' => 'pending'
        ]);
        
        Appointment::create([
            'patient_id' => 4,
            'doctor_id' => 5,
            'appointment_date' => now()->subDays(2),
            'status' => 'cancelled'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    /**
     * Store a newly created medical record for an appointment.
     */
    public function store(Request $request, Appointment $appointment)
    {
        // Ensure record doesn't already exist for this appointment
        if ($appointment->medicalRecord) {
            return response()->json([
                'message' => 'A medical record already exists for this appointment.'
            ], 400);
        }

        $validatedData = $request->validate([
            'notes' => 'required|string'
        ]);

        $record = $appointment->medicalRecord()->create([
            'notes' => $validatedData['notes']
        ]);

        return response()->json([
            'message' => 'Medical notes added successfully.',
            'data' => $record
        ], 201);
    }

    /**
     * Display the specified patient's full medical history.
     */
    public function patientHistory(Patient $patient)
    {
        // Get the patient along with their appointments and the associated medical records
        $patientHistory = $patient->load(['appointments.medicalRecord', 'appointments.doctor']);

        return response()->json([
            'data' => $patientHistory
        ]);
    }
}

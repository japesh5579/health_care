<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments.
     */
    public function index()
    {
        // Load relationships to avoid N+1 problem and paginate
        $appointments = Appointment::with(['patient', 'doctor'])->paginate(15);
        
        return response()->json($appointments);
    }

    /**
     * Store a newly created appointment.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:now',
        ]);

        $appointment = Appointment::create([
            'patient_id' => $validatedData['patient_id'],
            'doctor_id' => $validatedData['doctor_id'],
            'appointment_date' => $validatedData['appointment_date'],
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Appointment created successfully.',
            'data' => $appointment->load(['patient', 'doctor'])
        ], 201);
    }

    /**
     * Update the status of an appointment.
     */
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        $appointment->update([
            'status' => $validatedData['status']
        ]);

        return response()->json([
            'message' => 'Appointment status updated successfully.',
            'data' => $appointment
        ]);
    }
}

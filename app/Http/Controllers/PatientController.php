<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of patients.
     */
    public function index()
    {
        $patients = Patient::paginate(15);
        return response()->json($patients);
    }

    /**
     * Store a newly created patient.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:patients',
        ]);

        $patient = Patient::create($validatedData);

        return response()->json([
            'message' => 'Patient created successfully.',
            'data' => $patient
        ], 201);
    }

    /**
     * Display the specified patient with basic details.
     */
    public function show(Patient $patient)
    {
        return response()->json([
            'data' => $patient
        ]);
    }
}

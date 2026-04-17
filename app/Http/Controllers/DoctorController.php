<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of doctors.
     */
    public function index()
    {
        // Using pagination for large data sets
        $doctors = Doctor::paginate(15);
        
        return response()->json($doctors);
    }
}

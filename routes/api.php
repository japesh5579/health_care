<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes (Public)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Patient Management
    Route::prefix('patients')->group(function () {
        Route::get('/', [PatientController::class, 'index']);
        Route::post('/', [PatientController::class, 'store']);
        Route::get('/{patient}', [PatientController::class, 'show']);
        Route::get('/{patient}/records', [MedicalRecordController::class, 'patientHistory']);
    });

    // Doctor Management
    Route::prefix('doctors')->group(function () {
        Route::get('/', [DoctorController::class, 'index']);
    });

    // Appointment System
    Route::prefix('appointments')->group(function () {
        Route::get('/', [AppointmentController::class, 'index']);
        Route::post('/', [AppointmentController::class, 'store']);
        Route::patch('/{appointment}/status', [AppointmentController::class, 'updateStatus']);
        
        // Medical Records inside appointments
        Route::post('/{appointment}/records', [MedicalRecordController::class, 'store']);
    });
});

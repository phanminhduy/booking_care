<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;



Route::GET('/doctor', [DoctorController::class, 'api'])->name('api.doctor');

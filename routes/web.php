<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\CustomerController;

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\TimeDoctorController;
use Illuminate\Support\Facades\Route;

// Route user
route::group(['prefix' => 'user'], function () {
    Route::get('doctor', [DoctorController::class, 'doctor'])->name('doctor');
    Route::get('appointment/create/', [AppointmentController::class, 'create'])->name('user.appointment.create');
    Route::get('customer/create', [CustomerController::class, 'create'])->name('user.customer.create');
    Route::get('customer/getMoreDoctors', [DoctorController::class, 'getMoreDoctors'])->name('doctor.get_more_doctors');
    Route::post('customer/', [CustomerController::class, 'store'])->name('user.customer.store');
    Route::get('appoinment/selectTime', [AppointmentController::class, 'selectTime'])->name('user.appointment.selectTime');

});

Route::get('/', function () {
    return view('user.layout.homepage');
})->name('user.home');

//Route doctor
route::group(['prefix' => 'doctor'], function () {
    Route::get('login', [AuthController::class, 'doctorLogin'])->name('doctor.login');
    Route::get('logout', [AuthController::class, 'doctorLogout'])->name('doctor.logout');
    Route::post('auth/logging', [AuthController::class, 'doctorLogging'])->name('doctor.logging');
    Route::get('schedule', [DoctorController::class, 'workSchedule'])->name('doctor.schedule')->middleware('doctor');
    Route::get('info', [DoctorController::class, 'info'])->name('doctor.info')->middleware('doctor');
    Route::get('workSchedule', [DoctorController::class, 'workSchedule'])->name('doctor.workSchedule')->middleware('doctor');
    Route::get('doctorSchedule', [DoctorController::class, 'get_doctor'])->name('get_doctor')->middleware('doctor');
});

//Route admin
route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AuthController::class, 'adminLogin'])->name('admin.login');
    Route::get('logout', [AuthController::class, 'adminLogout'])->name('admin.logout');
    Route::POST('auth/logging', [AuthController::class, 'adminLogging'])->name('admin.logging');
});

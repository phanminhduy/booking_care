<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\UpdateRequest;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Time;
use App\Models\Time_doctor;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{

    public function __construct()
    {
        $this->model = (new Appointment())->query();
    }

    public function index(Request $request)
    {
        $appointments = $this->model
            ->with('time_doctor.time:id,date,time_start,time_end')
            ->with('time_doctor.doctor:id,name')
            ->with('time_doctor.doctor.specialist:id,name')
            ->with('customer:id,name_patient,phone_patient')
            ->where('status', '=', $request->status)
            ->latest('updated_at')
            ->paginate();
        $appointments->appends(['status' => $request->status]);
        return view('admin.appointment.index', [
            'appointments' => $appointments,
        ]);
    }

    public function create(Request $request)
    {
        $doctor_id = $request->doctor_id;
        $date = $request->date;
        $doctor = doctor::query()
            ->with('specialist')
            ->find($doctor_id);
        $specialists = (new specialist())->query()->get();
        return view('user.appointment.create', [
            'doctor' => $doctor,
            'specialists' => $specialists,
            'date' => $date
        ]);
    }

    public function selectTime(Request $request)
    {
        $time_doctors = (new time_doctor())->query()
            ->where('doctor_id', '=', $request->doctor_id)
            ->join('times', 'time_doctors.time_id', '=', 'times.id')
            ->where('date', '=', $request->date)
            ->leftJoin('appointments', 'time_doctors.id', '=', 'appointments.time_doctor_id')
            ->select('time_doctors.id', 'status', 'date', 'time_start', 'time_end')
            ->orderBy('time_start')
            ->get();

        return $time_doctors;
    }

    public function update(UpdateRequest $request, Appointment $appointment)
    {
        $admin_id = Auth::id();
        $appointment->fill($request->validated());
        $appointment['admin_id'] = $admin_id;
        $appointment->save();
        return redirect()->back();
    }
}

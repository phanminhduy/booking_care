<?php

namespace App\Http\Controllers;

use App\Http\Requests\customer\StoreRequest;
use App\Http\Requests\customer\UpdateRequest;
use App\Models\Customer;
use App\Models\Time_doctor;
use App\Models\Appointment;
use App\Models\Specialist;
use Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->model = (new Customer())->query();
    }

    public function index(Request $request)
    {
        $search = $request->get('q');
        $customers = $this->model
            ->where('name_patient', 'like', '%' . $search . "%")
            ->orwhere('phone_patient', 'like', '%' . $search . "%")
            ->orwhere('email', 'like', '%' . $search . "%")
            ->paginate();
        $customers->appends(['q' => $search]);
        return view('admin.customer.index', [
            'customers' => $customers,
            'search' => $search,
        ]);
    }

    public function create(Request $request)
    {
        $time_doctors = (new time_doctor())->query()
            ->join('doctors', 'doctor_id', '=', 'doctors.id')
            ->where('time_doctors.id', '=', $request->doctor_id)
            ->select('time_doctors.id', 'doctors.price')
            ->get();

        return $time_doctors;
    }

    public function store(StoreRequest $request)
    {

        $customer = new customer();

        //Validate appointment
        if (Appointment::where('time_doctor_id', '=', $request->time_doctor_id)->count() > 0) {
            return back()->withInput();
        }

        //Check exited customer
        $customer = Customer::firstOrCreate([
            'email' =>  request('email'),
            'phone_patient' => request('phone_patient'),
        ], [
            'name_patient' => request('name_patient'),
            'birth_date' => request('birth_date'),
        ]);

        $customer->fill($request->validated());
        $customer->save();

        //Create new appointment
        $appointment = new appointment();
        $appointment['customer_id'] = $customer->id;
        $appointment['status'] = 1;
        $appointment->fill($request->except('name_patient'));

        // $appointment['description'] = $request->input('description');
        $appointment->save();
        return Response::json([
            'success' => true,
        ], 200);
    }

    public function viewAppointment($customer)
    {
        $appointments = Appointment::query()
            ->where('customer_id', '=', $customer)
            ->paginate();
        return view('admin.customer.viewAppointment', [
            'appointments' => $appointments,
        ]);
    }

    public function show(customer $customer)
    {
        //
    }

    public function edit(customer $customer)
    {
    }

    public function update(StoreRequest $request, $customer)
    {
    }

    public function destroy(customer $customer)
    {
    }
}

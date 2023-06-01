<?php

namespace App\Http\Controllers;

use App\Http\Requests\Doctor\StoreRequest;
use App\Http\Requests\Doctor\UpdateRequest;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\Time_doctor;
use App\Models\Time;
use App\Models\Config;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    use ResponseTrait;

    public function __construct()
    {
        $this->model = (new Doctor())->query();
    }

    public function index(Request $request)
    {
        $search = $request->get('q');
        $doctors = $this->model->with('specialist:id,name')
            ->where('name', 'like', '%' . $search . "%")
            ->orwhere('phone', 'like', '%' . $search . "%")
            ->orwhere('email', 'like', '%' . $search . "%")
            ->paginate(3);
        $doctors->appends(['q' => $search]);
        return view('admin.doctor.index', [
            'doctors' => $doctors,
            'search' => $search,
        ]);
    }

    public function api(Request $request)
    {
        $data = $this->model
            ->select('id', 'name')
            ->where('specialist_id', '=', $request->get('id'))
            ->get();
        return $this->successResponse($data);
    }


    public function create()
    {
        $specialists = Specialist::query()->get();
        return view('admin.doctor.create', [
            'specialists' => $specialists,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $path = Storage::disk('public')->putFile('avatars', $request->file('avatar'));
        $object = new doctor();
        $object->fill($request->validated());
        $object['avatar'] = $path;
        $object->save();
        return redirect()->route('admin.doctor.index');
    }

    public function show(doctor $doctor)
    {
    }

    public function edit(doctor $doctor)
    {
        $specialists = Specialist::query()->get();
        return view('admin.doctor.edit', [
            'doctor' => $doctor,
            'specialists' => $specialists,
        ]);
    }

    public function update(UpdateRequest $request, $doctor)
    {
        $object = Doctor::query()->find($doctor);
        $object->fill($request->validated());
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->putFile('avatars', $request->file('avatar'));
            $object['avatar'] = $path;
        }
        $object->save();
        return redirect()->route('admin.doctor.index');
    }

    public function destroy(doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('admin.doctor.index');
    }

    public function resetPassword(Doctor $doctor)
    {
        $doctor['password'] = Hash::make(123456);
        $doctor->save();
    }

    public function doctor(Request $request)
    {
        $configs = Config::getAndCache(0);
        $min_price = $request->get('min_price', $configs['filter_min_price']);
        $max_price = $request->get('max_price', $configs['filter_max_price']);

        $doctors = $this->model
            ->with('specialist:id,name')
            ->paginate(9);

        $specialists = Specialist::query()->get();

        return view('user.doctor.index', [
            'doctors' => $doctors,
            'specialists' => $specialists,
            'configs' => $configs,
            'min_price' => $min_price,
            'max_price' => $max_price,
        ]);
    }

    public function info()
    {
        $doctor_id = Auth::guard('doctor')->id();
        $doctor = Doctor::with('specialist')->find($doctor_id);
        return view('user.doctor.info', [
            'doctor' => $doctor,
        ]);
    }

    public function workSchedule()
    {
        return view('user.doctor.workSchedule');
    }

    public function get_doctor()
    {
        $doctor_id = Auth::guard('doctor')->id();
        $doctor = Time_doctor::query()
            ->join('doctors', 'doctors.id', '=', 'time_doctors.doctor_id')
            ->join('times', 'times.id', '=', 'time_doctors.time_id')
            ->leftjoin('appointments', 'appointments.time_doctor_id', '=', 'time_doctors.id')
            ->leftjoin('customers', 'customers.id', '=', 'appointments.customer_id')
            ->select([
                'name as title',
                time::raw("CONCAT(times.date,' ',times.time_start) AS start"),
                time::raw("CONCAT(times.date,' ',times.time_end) AS end"),
                'customers.name_patient',
                'customers.phone_patient',
                'customers.email',
                'customers.gender',
                'customers.birth_date',
                'appointments.description',
                'appointments.status',
            ])
            ->where('doctors.id', '=', $doctor_id)
            ->get();
        return response()->json($doctor);
    }

    public function getMoreDoctors(Request $request) {
        $doctors = $this->model;
        $time_doctor = Time_doctor::query();
        $date = Carbon::parse($request->date)->format('Y-m-d');

        if($request->has('orderValue')) {
            //Get order value
            $orderValue = $request->orderValue ?? 'desc';
            //Get specialist value
            $specialist = $request->get('specialist');

            if (!empty($request->date)) {
                // Get date and time
                $time_start = Carbon::parse($request->time_start ?? '00:00:00')->format('H:i:s');
                $time_end = Carbon::parse($request->time_end ?? '23:59:59')->format('H:i:s');
                $date = Carbon::parse($request->date)->format('Y-m-d');

                //Get free time
                $time_doctor = $time_doctor->whereRelation('time', function ($query) use ($date, $time_start, $time_end) {
                    $query->where('date', '=', $date)
                        ->where('time_start', '>', $time_start)
                        ->where('time_end', '<', $time_end);
                })
                    ->whereDoesntHave('appointment', function ($query) {
                        $query->where('status', '=', 2);
                    })
                    ->get()
                    ->unique('doctor_id')
                    ->pluck('doctor_id')->toArray();

                $doctors->whereIn('id', $time_doctor);
            }

            //Get free doctor
            $doctors ->whereBetween('price', [$request->min_price, $request->max_price])
                ->orderBy('price', $orderValue);

            //Check if specialist exit
            if (!empty($specialist)) {
                $doctors->where('specialist_id', '=', $request->specialist);
            }
        }

        if($request->has('name')) {
            $doctors ->where("name", "like", "%" . $request->name . "%");
        }

        $doctors = $this->model->paginate(9);

        //Check request ajax
        if ($request->ajax()) {
            return view('user.doctor.doctor-pagination', [
                'doctors' => $doctors,
                'date' => $date ?? ''
            ]);
        }
    }
}

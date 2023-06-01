<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\Time;
use App\Models\Time_doctor;
use App\Http\Requests\StoreTime_doctorRequest;
use App\Http\Requests\UpdateTime_doctorRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Label84\HoursHelper\HoursHelper;
use stdClass;

class TimeDoctorController extends Controller
{
    public function __construct()
    {
        $this->model = (new time_doctor())->query();
    }

    public function index(Request $request)
    {
        $search = $request->get('q');
        $date = $request->get('date');
        $time_doctors = $this->model
            ->with('appointment:time_doctor_id,status,price')
            ->with('doctor:id,name')
            ->with('time:id,date,time_start,time_end')
            ->with('doctor.specialist:id,name')
            ->orderBy('id')
            ->whereRelation('doctor', 'name', 'like', '%'.$search."%")
            ->whereRelation('time', 'date', 'like', '%'.$date."%")
            ->paginate();
        $time_doctors->appends(['q' => $search]);
        $time_doctors->appends(['date' => $date]);
        return view('admin.timework.index', [
            'time_doctors' => $time_doctors,
            'search' => $search,
            'date' => $date,
        ]);
    }

    public function create()
    {
        $specialists = Specialist::query()->get();
        return view('admin.timework.create', [
            'specialists' => $specialists,
        ]);
    }

    public function getTime($request)
    {
        $times = [];
        $date_time = $request->only([
            'date',
            'time_start',
            'time_end',
            'timework',
        ]);
        $array = [];
        $i = 0;
        // array to object
        while ($i < count($date_time['date'])) {
            $object = new stdClass();
            foreach ($date_time as $key => $value) {
                $object->$key = $value[$i];
            }
            $dates = explode(' - ', $object->date);
            $object->date_start = $dates[0];
            $object->date_end = $dates[1];
            $array[] = $object;
            $i++;
        }

        foreach ($array as $each) {
            $date = Carbon::createFromFormat('d/m/Y', $each->date_start)->format('Y-m-d');
            $date_end = Carbon::createFromFormat('d/m/Y', $each->date_end)->format('Y-m-d');
            while ($date <= $date_end) {
                $time = Carbon::parse($each->time_start)->format('H:i');
                $time_end = Carbon::parse($each->time_end)->subMinute($each->timework)->format('H:i');
                while ($time <= $time_end) {
                    $arrtime = [
                        'date' => $date,
                        'time_start' => $time,
                        'time_end' => Carbon::parse($time)->addMinute($each->timework)->format('H:i'),
                    ];
                    $time = Carbon::parse($time)->addMinute($each->timework)->format('H:i');
                    $times[] = $arrtime;
                }
                $date = Carbon::createFromFormat('Y-m-d', $date)->addDays(1)->format('Y-m-d');
            }
        }
        return $times;
    }

    public function store(Request $request)
    {
        $times = $this->getTime($request);
        $doctor_id = $request->doctor_id;
        foreach ($doctor_id as $doctor) {
            foreach ($times as $each) {
                $time_doctor = new Time_doctor();
                $time = Time::query()->firstOrCreate($each);
                $time_doctor['time_id'] = $time->id;
                $time_doctor['doctor_id'] = $doctor;
                $time_doctor->save();
            }
        }
    }

    public function edit(Time_doctor $time_doctor)
    {
        return view('admin.timework.edit', [
            'time_doctor' => $time_doctor,
        ]);

    }

    public function update(Request $request)
    {
        $time_doctor = Time_doctor::query()->find($request->time_doctor_id);
        $arr = [
            'date' => $request->date,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
        ];
        $time = Time::query()->firstOrCreate($arr);
        $time_doctor['time_id'] = $time->id;
        $time_doctor->save();


    }

    public function destroy(Request $request)
    {
        time_doctor::query()->find($request->time_doctor_id)->delete();
    }

    public function workSchedule()
    {
        $specialists = Specialist::query()->get();
        return view('admin.timework.workSchedule', [
            'specialists' => $specialists,
        ]);
    }

    public function get_schedule(Request $request)
    {
        $doctor_id = $request->doctor_id;
        $specialist_id = $request->specialist_id;

        $doctor = Time_doctor::query()
            ->join('doctors', 'doctor_id', '=', 'doctors.id')
            ->join('specialists', 'doctors.specialist_id', '=', 'specialists.id')
            ->join('times', 'times.id', '=', 'time_doctors.time_id')
            ->leftJoin('appointments', 'appointments.time_doctor_id', '=', 'time_doctors.id')
            ->when($request->has('doctor_id'), function ($doctor) use ($doctor_id) {
                $doctor->whereIn('doctor_id', $doctor_id);
            })
            ->when($specialist_id!="", function ($doctor) use ($specialist_id) {
                $doctor->where('doctors.specialist_id', '=',$specialist_id);
            })
            ->select([
                'doctors.name as title',
                time::raw("CONCAT(times.date,' ',times.time_start) AS start"),
                time::raw("CONCAT(times.date,' ',times.time_end) AS end"),
                'status',
                'time_doctors.id as time_doctor',
                'times.date as time_date',
                'times.time_start as time_start',
                'times.time_end as time_end',
            ])

            ->get();
        return response()->json($doctor);
    }


}
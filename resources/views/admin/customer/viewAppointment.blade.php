@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">
                        Lịch hẹn của bệnh nhân
                    </h4>

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                            <tr>
                                <th>#</th>
                                <th>Ngày đặt lịch</th>
                                <th>Tên chuyên ngành</th>
                                <th>Tên bác sĩ</th>
                                <th>Ngày khám</th>
                                <th>Khung giờ khám</th>
                                <th>Mô tả</th>
                                <th>Tên bệnh nhân</th>
                                <th>Số điện thoại</th>
                                <th>Tình trạng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($appointments[0]===null)
                                <tr>
                                    <td>Trống</td>
                                </tr>
                            @else
                                @foreach($appointments as $appointment)
                                <tr>
                                    <td>
                                        {{ $appointment->id }}
                                    </td>
                                    <td>
                                        {{ $appointment->DateCreatedAt }}
                                    </td>
                                    <td>
                                        {{$appointment->time_doctor->doctor->specialist->name}}
                                    </td>
                                    <td>
                                        {{$appointment->time_doctor->doctor->name}}
                                    </td>
                                    <td>
                                        {{ $appointment->time_doctor->time->dateformat}}
                                    </td>
                                    <td>
                                        {{ $appointment->time_doctor->time->time_start ."-".  $appointment->time_doctor->time->time_end}}
                                    </td>
                                    <td>
                                        {{ $appointment->description}}
                                    </td>
                                    <td>
                                        {{$appointment->customer->name_patient}}
                                    </td>
                                    <td>
                                        {{$appointment->customer->phone_patient}}
                                    </td>
                                    <td>
                                        {{ \App\Enums\AppointmentStatusEnum::getKeyByValue($appointment->status) }}
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>

                        </table>
                        {{ $appointments->links('admin.paginator.index') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


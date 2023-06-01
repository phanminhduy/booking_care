@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">
                        @if($appointments[0])
                        @if($appointments[0]->status===1)
                            Lịch hẹn cần phê duyệt
                        @elseif($appointments[0]->status===2)
                            Lịch hẹn đã phê duyệt
                        @else
                            Lịch hẹn đã huỷ
                        @endif
                        @endif
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
                                @if($appointments[0])
                                @if($appointments[0]->status===1)
                                    <th>Duyệt</th>
                                @endif
                                @if($appointments[0]->status===1 || $appointments[0]->status===2)
                                    <th>Huỷ</th>
                                @endif
                                @endif
                            </tr>
                            </thead>
                            <tbody>
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
                                    @if($appointments[0]->status===1)
                                        <td>
                                            <form action="{{route('admin.appointment.update',$appointment)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="2">
                                                <input type="hidden" name="time_doctor_id" value="{{$appointment->time_doctor->id}}">
                                                <button class="btn btn-success" style="margin-top: 25px">Duyệt</button>
                                            </form>
                                        </td>
                                    @endif
                                    @if($appointments[0]->status===1 || $appointments[0]->status===2)
                                        <td>
                                            <form action="{{route('admin.appointment.update',$appointment)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="3">
                                                <button class="btn btn-danger" style="margin-top: 25px">Huỷ</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{ $appointments->links('admin.paginator.index') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script>
        $(function () {
            $(".collapse").collapse();
        })
    </script>
@endpush

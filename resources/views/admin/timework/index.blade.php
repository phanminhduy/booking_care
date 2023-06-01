@extends('admin.layout.master')
@section('content')
    <a class="btn btn-success" href="{{route('admin.time_doctor.create')}}">
        Thêm
    </a>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Quản lý lịch làm việc</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <caption class=" col-md-offset-2">
                                <form action="{{route('admin.time_doctor.index')}}">
                                        Tên bác sĩ:
                                        <input type="search" name="q" value="{{$search}}"
                                                       style="height: 28px; width: 300px">
                                        Ngày khám:
                                        <input type="text" class="datepicker" name="date"
                                               value="{{$date}}"/>
                                    <button>Tìm kiếm</button>
                                </form>
                            </caption>
                            <thead class="text-primary">
                            <tr>
                                <th>#</th>
                                <th>Tên bác sĩ</th>
                                <th>Chuyên ngành</th>
                                <th>Ngày khám</th>
                                <th>Khung giờ khám</th>
                                <th>Thời gian khám</th>
                                <th>Tình trạng</th>
                                <th>Sửa</th>
                                <th>Xoá</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($time_doctors as $time_doctor)
                                <tr>
                                    <td>
                                        {{ $time_doctor->id }}
                                    </td>
                                    <td>
                                        {{ $time_doctor->doctor->name }}
                                    </td>
                                    <td>
                                        {{ $time_doctor->doctor->specialist->name }}
                                    </td>
                                    <td>
                                        {{ $time_doctor->time->dateformat}}
                                    </td>
                                    <td>
                                        {{ $time_doctor->time->time_start ."-".  $time_doctor->time->time_end}}
                                    </td>
                                    <td>
                                        {{$time_doctor->time->time}}
                                    </td>
                                    <td>
                                        @if($time_doctor->appointment)
                                            @if ($time_doctor->appointment->status===1 || $time_doctor->appointment->status===2)
                                                {{ \App\Enums\AppointmentStatusEnum::getKeyByValue($time_doctor->appointment->status) }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.time_doctor.edit',$time_doctor)}}">
                                            <button class="btn btn-info">Sửa</button>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{route('admin.time_doctor.destroy',$time_doctor)}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" style="margin-top: 25px">Xoá</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{ $time_doctors->links('admin.paginator.index') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.datepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            })
        });
    </script>
@endpush

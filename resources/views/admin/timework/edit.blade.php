@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-text" data-background-color="rose">
                    <h4 class="card-title">Sửa giờ làm việc</h4>
                </div>
                <form method="post" action="{{route('admin.time_doctor.update',$time_doctor)}}">
                    @csrf
                    @method('PUT')
                    <div class="card-content">
                        <div id="add_row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="label-control">Tên Bác sĩ</label>
                                    <input type="text" value="{{$time_doctor->doctor->name}}" readonly="readonly"/>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-content">
                                            <h4 class="card-title">Chọn ngày</h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control datepicker" name="date"
                                                       value="{{$time_doctor->time->dateformat}}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-content">
                                            <h4 class="card-title">Chọn giờ bắt đầu</h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control timepicker" name="time_start"
                                                       value="{{$time_doctor->time->time_start}}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-content">
                                            <h4 class="card-title">Chọn giờ kết thúc</h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control timepicker" name="time_end"
                                                       value="{{$time_doctor->time->time_end}}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="time_id" value="{{$time_doctor->time_id}}">
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-rose btn-fill">Cập nhật</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script>
        $('.datepicker').datetimepicker({
            format: 'DD/MM/YYYY',
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
        });
        $('.timepicker').datetimepicker({
            format: 'h:mm A',
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
        });
    </script>
@endpush
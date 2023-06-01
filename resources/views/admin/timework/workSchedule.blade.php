@extends('admin.layout.master')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    {{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">--}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

@endpush
@section('content')
    <a class="btn btn-success" id="create_schedule">
        Thêm
    </a>
    <div class="row">
        <div class="col-lg-3">
            <label class="label-control">Chọn Chuyên ngành</label>
            <select class="selectpicker" data-style="btn btn-primary btn-round"
                    title="Chọn Chuyên ngành" data-size="7" name="specialist_id"
                    id="select-specialist">
                <option value=""></option>
                @foreach($specialists as $specialist)
                    <option value="{{ $specialist->id }}">
                        {{ $specialist->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3">
            <label class="label-control">Chọn Bác sĩ</label>
            <select class="selectpicker select-doctor" multiple name="doctor_id"
                    data-style="btn btn-primary btn-round"
                    id='select-doctor'>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="calendar"></div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tạo khung giờ làm việc</h4>
                </div>
                <div class="modal-body">
                    <form method="post" class="form-horizontal" id="form_create_schedule">
                        @csrf
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Thêm giờ làm việc</h4>
                        </div>
                        <div class="card-content">
                            <div id="add_row">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="label-control">Chọn Chuyên ngành</label>
                                        <select class="selectpicker" data-style="btn btn-primary btn-round"
                                                title="Chọn Chuyên ngành" data-size="7" name="specialist"
                                                id="select_specialist">
                                            @foreach($specialists as $specialist)
                                                <option value="{{ $specialist->id }}">
                                                    {{ $specialist->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="label-control">Chọn Bác sĩ</label>
                                        <select class="selectpicker select-doctor" multiple name="doctor_id[]"
                                                data-style="btn btn-primary btn-round"
                                                id='select_doctor'>
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-content">
                                                <h4 class="card-title">Chọn ngày</h4>
                                                <div class="form-group">
                                                    <input type="text" class="form-control datepicker" name="date[]"
                                                           value="now"/>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-content">
                                                <h4 class="card-title">Chọn giờ bắt đầu</h4>
                                                <div class="form-group">
                                                    <input type="text" class="form-control timepicker"
                                                           name="time_start[]"
                                                           value="08:00"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-content">
                                                <h4 class="card-title">Chọn giờ kết thúc</h4>
                                                <div class="form-group">
                                                    <input type="text" class="form-control timepicker" name="time_end[]"
                                                           value="08:00"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <br><br><br>
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label">Thời gian khám</label>
                                            <input type="text" class="form-control" name="timework[]">
                                            <span class="material-input"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 " id="div-btn-add-time">
                                <button type="submit" class="btn btn-success" id="btn_add_time">Thêm khung giờ</button>
                            </div>
                        </div>
                        <br><br>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-rose btn-fill">Thêm</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="editSchedule" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sửa khung giờ làm việc</h4>
                </div>
                <div class="modal-body">
                    <form method="post" class="form-horizontal" id="form_edit_schedule">
                        @csrf
                        @method('PUT')
                        <div class="card-content">
                            <div id="add_row">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="label-control">Tên Bác sĩ</label>
                                        <input id="doctor_name" type="text" readonly="readonly"/>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-content">
                                                <h4 class="card-title">Chọn ngày</h4>
                                                <div class="form-group">
                                                    <input id="date" type="text" class="form-control datepicker2"
                                                           name="date"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-content">
                                                <h4 class="card-title">Chọn giờ bắt đầu</h4>
                                                <div class="form-group">
                                                    <input id="time_start" type="text" class="form-control timepicker"
                                                           name="time_start"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-content">
                                                <h4 class="card-title">Chọn giờ kết thúc</h4>
                                                <div class="form-group">
                                                    <input id="time_end" type="text" class="form-control timepicker"
                                                           name="time_end"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="time_doctor_id" type="hidden" name="time_doctor_id">
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="card-footer text-center">
                            <button type="submit" id="btn_edit" class="btn btn-rose btn-info">Cập nhật</button>
                            <button type="button" id="btn_delete" class="btn btn-rose btn-dange">Xoá</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
    {{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function () {

            $("#create_schedule").click(function () {
                $('#myModal').modal('show');
            });

            $('#select-specialist').change(function () {
                $("#select-doctor option").remove();
                let id = $(this).val();
                $.ajax({
                    url: '{{ route('api.doctor') }}',
                    data: {
                        "id": id
                    },
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        $.each(data.data, function (index, each) {
                            $('#select-doctor').append($('<option>', {value: each.id, text: each.name}));
                        });
                        $("#select-doctor").selectpicker('refresh')

                    },
                });
            });
            $('#select_specialist').change(function () {
                $("#select_doctor option").remove();
                let id = $(this).val();
                $.ajax({
                    url: '{{ route('api.doctor') }}',
                    data: {
                        "id": id
                    },
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        $.each(data.data, function (index, each) {
                            $('#select_doctor').append($('<option>', {value: each.id, text: each.name}));
                        });
                        $("#select_doctor").selectpicker('refresh')

                    },
                });
            });
            $(document).ready(function () {
                $('input[name="date[]"]').daterangepicker({
                    locale: {
                        format: 'DD/MM/YYYY'
                    }

                });
                $('.datepicker2').datetimepicker({
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
            });
            $("#btn_add_time").on('click', function () {
                $('#add_row').append($(`
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Chọn ngày</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control datepicker" name="date[]" value="now"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Chọn giờ bắt đầu</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control timepicker" name="time_start[]" value="08:00"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Chọn giờ kết thúc</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control timepicker" name="time_end[]" value="08:00"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <br><br><br>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Thời gian khám</label>
                            <input type="text" class="form-control" name="timework[]">
                            <span class="material-input"></span></div>
                    </div>
                </div>
            `));
                $('input[name="date[]"]').daterangepicker({
                    locale: {
                        format: 'DD/MM/YYYY'
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
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                {{--events: '{{ route('admin.get_schedule') }}',--}}
                events: function (fetchInfo, successCallback, failureCallback) {
                    var doctor_id = $('#select-doctor').val();
                    var specialist_id = $('#select-specialist').val();
                    $.ajax({
                        type: "GET",
                        url: "{{ route('admin.get_schedule') }}",
                        data: {
                            "doctor_id": doctor_id,
                            "specialist_id": specialist_id,
                        },
                    }).done(function (data) {
                        successCallback(data); //use the supplied callback function to return the event data to fullCalendar
                    })
                },
                initialView: 'dayGridMonth',
                dayMaxEvents: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                eventDidMount: function (info) {
                    if (info.event.extendedProps.status === 1) {
                        info.el.style.backgroundColor = 'blue';
                    } else if (info.event.extendedProps.status === 2) {
                        info.el.style.backgroundColor = 'purple';
                    }
                },
                eventClick: function (info) {
                    if (info.event.extendedProps.status !== 1 && info.event.extendedProps.status !== 2) {
                        $('#doctor_name').val(info.event.title);
                        $('#date').val(info.event.extendedProps.time_date);
                        $('#time_start').val(info.event.extendedProps.time_start);
                        $('#time_end').val(info.event.extendedProps.time_end);
                        $('#time_doctor_id').val(info.event.extendedProps.time_doctor);
                        $('#editSchedule').modal('show');
                    }
                }
            });
            calendar.render();
            $('#select-doctor').change(function () {
                calendar.refetchEvents();
            });
            $('#select-specialist').change(function () {
                calendar.refetchEvents();
            });
            $('#form_create_schedule').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('admin.time_doctor.store')}}",
                    data: $(this).serialize(),
                    type: 'POST',
                    dataType: 'json',
                    complete: function (data) {
                        calendar.refetchEvents();
                        $('#myModal').modal('hide');
                        $('#form_create_schedule').reset();
                    },
                });
            })
            $('#form_edit_schedule').submit(function (event) {
                let time_doctor_id = $('#time_doctor_id').val();
                event.preventDefault();
                $.ajax({
                    url: "{{route('admin.time_doctor.update')}}?id=" + time_doctor_id,
                    data: $(this).serialize(),
                    type: 'POST',
                    dataType: 'json',
                    complete: function (data) {
                        calendar.refetchEvents();
                        $('#editSchedule').modal('hide');
                        // $('#form_edit_schedule').reset();
                    },
                });
            })
            $('#btn_delete').click(function (event) {
                let time_doctor_id = $('#time_doctor_id').val();
                $.ajax({
                    url: "{{route('admin.time_doctor.destroy')}}?id=" + time_doctor_id,
                    data: {
                        "time_doctor_id": time_doctor_id,
                        "_method": 'delete',
                        "_token": "{{ csrf_token() }}",
                    },
                    type: 'POST',
                    dataType: 'json',
                    complete: function (data) {
                        calendar.refetchEvents();
                        $('#editSchedule').modal('hide');
                        // $('#form_edit_schedule').reset();
                    },
                });
            })
        });


    </script>
@endpush
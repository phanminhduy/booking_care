@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="{{route('admin.time_doctor.store')}}" class="form-horizontal">
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
                                            id="select-specialist">
                                        @foreach($specialists as $specialist)
                                            <option value="{{ $specialist->id }}">
                                                {{ $specialist->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="label-control">Chọn Bác sĩ</label>
                                    <select class="selectpicker select-doctor" multiple  name="doctor_id[]"
                                            data-style="btn btn-primary btn-round"
                                            id='select-doctor'>
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
                                                <input type="text" class="form-control timepicker" name="time_start[]"
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
                            <button type="button" class="btn btn-success" id="btn_add_time">Thêm khung giờ</button>
                        </div>
                    </div>
                    <br><br>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-rose btn-fill">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <script>
        $(document).ready(function () {
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

        })
        ;
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
                // error: function()
                // {
                //     //handle errors
                //     alert('error...');
                // }
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
    </script>
@endpush
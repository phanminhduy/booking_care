@extends('user.layout.master')
@section('content')
    <div class="row" style="display: flex; justify-content: space-between; padding: 20px;">
        <div class="col-sm-5 col-sm-offset-1 text-center" style="margin: 0">
            <img src="{{ asset($doctor->avatar) }}" alt="Thumbnail Image"
                 class="img-circle img-raised img-responsive center-block"
                 style="height: 140px; width: 150px; object-fit: cover; object-position: top">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <i class="fa-solid fa-star text-rose" style="font-size:14px;"></i>
                        <span class="text-primary" style="font-size:14px; font-weight: 500;">5.0</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <i class="fa-solid fa-eye text-rose" style="font-size:14px;"></i>
                        <span class="text-primary" style="font-size:14px; font-weight: 500;">5K</span>
                    </div>
                </div>
            </div>
            <h4 class="title">
                <span class="tim-note">Bác sĩ {{ $doctor->name }}</span>
            </h4>
            <p class="text-muted">
                @foreach ($specialists as $specialist)
                    @if ($specialist->id === $doctor->specialist_id)
                        {{ $specialist->name }}
                    @endif
                @endforeach
            </p>
            <div class="progress progress-line-primary" style="margin-top: 20px;">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                     style="width: 100%;">
                </div>
            </div>
            <h4 class="title text-left">
                <span class="tim-note ">Thông tin</span>
            </h4>
            <div class="row" style="display: flex; justify-content: space-around; align-item: center;">
                <button type="button" class="btn"
                        style="width: 28.5%; display: flex; flex-direction: column; justify-content: center; align-items: center; background-color: #bdbdbd;">
                    <p>Giá</p>
                    <span> {{ $doctor->price }}</span>
                </button>

                <button type="button" class="btn btn-default"
                        style="width: 28.5%; display: flex; flex-direction: column; justify-content: center; align-items: center; background-color: #bdbdbd;">
                    <p>Kinh nghiệm</p>
                    <span> > {{ $doctor->experience }} năm</span>
                </button>

                <button type="button" class="btn btn-default"
                        style="width: 28.5%; display: flex; flex-direction: column; justify-content: center; align-items: center; background-color: #bdbdbd;">
                    <p>Bệnh nhân</p>
                    <span>600 +</span>
                </button>
            </div>
            <div class="progress progress-line-primary" style="margin-top: 20px;">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                     style="width: 100%;">
                </div>
            </div>
            <h4 class="title text-left">
                <span class="tim-note ">Tiểu sử</span>
                <blockquote style="margin-top: 20px;">
                    <small>
                        Bác sĩ cấp cứu tổng hợp Bệnh viện quận Tân Phú
                    </small>
                    <small>
                        Bác sĩ cấp cứu Phòng khám Hoàn Mỹ Sài Gòn
                    </small>
                </blockquote>
            </h4>
        </div>
        <div class="col-sm-7 col-sm-offset-1" style="margin: 0;">
            <h2 class="title text-center" style="margin-top:0; margin-bottom: 0;">Đăng kí lịch hẹn</h2>

            {{-- Pick time booking appointment --}}
            <div class="form-group col-md-4">
                    <label class="label-control">Chọn ngày</label>
                    <input type="text" class="form-control" id="date" value="{{ $date }}"/>
            </div>

            <div class="form-group col-md-12">
                <div class="form-group">
                    <label class="label-control">Chọn giờ</label>
                    <div class="row" id="time">
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Modal create customer --}}
<div class="modal fade in" id="modal-create-customer" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="overflow: auto">
            <div class="modal-header" style="background-color: #e91e63; color: #fff; padding-bottom: 24px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: #fff">
                    <i class="material-icons">clear</i>
                </button>
                <h4 class="modal-title text-center text-uppercase" style="letter-spacing: 4px;">Nhập thông tin</h4>
            </div>
            <div class="modal-body">
                <form id="form-create-customer">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group is-empty">
                                <input type="text" name="name_booking" placeholder="Tên người đăng kí"
                                       class="form-control" value="{{ old('name_booking') }}">
                                <span class="material-input"></span>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group is-empty">
                                <input type="text" name="phone_booking" placeholder="Số điện thoại" class="form-control"
                                       value="{{ old('phone_booking') }}">
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group is-empty">
                                <input type="text" name="name_patient" placeholder="Tên bệnh nhân" class="form-control"
                                       value="{{ old('name_patient') }}">
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group is-empty">
                                <input type="text" name="phone_patient" placeholder="Số điện thoại" class="form-control"
                                       value="{{ old('phone_patient') }}">
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group is-empty">
                                <input type="email" name="email" placeholder="Email" class="form-control"
                                       value="{{ old('email') }}">
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group is-empty" style="display: flex; align-items: center;">
                                <label class="pull-left" style="margin-bottom: 0">Giới tính</label>
                                <div class="row">
                                    <div class="col-lg-3 col-sm-4 checkbox-radios" style="margin-right: 20px;">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" checked="true" value="1">
                                                <span class="circle"></span><span class="check"></span> Nam
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-4 checkbox-radios">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" value="0">
                                                <span class="circle"></span><span class="check"></span> Nữ
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group">
                                <label class="pull-left">Ngày sinh</label>
                                <input id="datepicker" type="text" name="birth_date" class="form-control datepicker"
                                       value="{{ old('birth_date') }}">
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 40px;">
                        <div class="form-group col-lg-12 col-sm-12">
                            <label class="pull-left">Tình trạng sức khỏe</label>
                            <textarea id="description" name="description" class="form-control" rows="3"
                                      value="{{ old('description') }}"></textarea>
                        </div>
                    </div>

                    <div id="input-hidden-container"></div>

                    <input class="col-lg-12 col-sm-12 btn btn-rose btn-square" type="submit" value="Đăng kí" style="margin-top: 26px;"/>
                </form>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{--    <script src="{{ asset('/js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>--}}
    <script>
        //Render dates available to booking
        function renderDateAvailable() {
            const myNode = document.getElementById("time");
            myNode.innerHTML = '';
            let date = $("#date").val();
            let doctor_id = {{ $doctor->id }};
            let current_date = moment(new Date()).format('YYYY-MM-DD');
            let current_time = moment(new Date()).add(1, 'hours').format('HH:mm:ss');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url(route('user.appointment.selectTime')) }}",
                data: {'date': date, 'doctor_id': doctor_id},
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    let timeDiv = document.getElementById('time');
                    $.each(data, function (index, each) {
                        let status = each.status;

                        if (status == 2 || status == 1 || current_date > each.date) {
                            timeDiv.innerHTML += `
                            <div class="col-md-4">
                                <a class="btn btn-square btn-block" disabled>
                                    <i class="material-icons">assignment</i>`
                                + each.time_start + '-' + each.time_end +
                                `<div class="ripple-container"></div>
                                </a>
                            </div>`
                        } else {
                            timeDiv.innerHTML += `
                            <div class="col-md-4">
                                <button
                                    id="btn-select-time"
                                    class="btn btn-primary btn-square btn-block"
                                    onclick="openCustomerCreateModal(`+each.id+`)"
                                >
                                    <i class="material-icons">assignment</i>`
                                    + each.time_start + '-' + each.time_end +
                                    `<div class="ripple-container"></div>
                                </button>
                            </div>
                            `
                        }
                    });
                },
            });
        }

        //Open modal create customer
        function openCustomerCreateModal(id) {
            let doctor_id = id;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url(route('user.customer.create')) }}",
                data: { 'doctor_id': doctor_id},
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    let inputContainer = document.getElementById('input-hidden-container');
                    inputContainer.innerHTML += `
                         <input type="hidden" name="time_doctor_id" value="`+ data[0].id +`">
                         <input type="hidden" name="price" value="`+ data[0].price +`">
                    `;
                },
            });
            $('#modal-create-customer').modal('show');
        }

        //Create appointment
        function createAppointment() {
            let name_booking = $('input[name=name_booking]').val();
            let phone_booking = $('input[name=phone_booking]').val();
            let name_patient = $('input[name=name_patient]').val();
            let phone_patient = $('input[name=phone_patient]').val();
            let email = $('input[name=email]').val();
            let gender = $('input[name=gender]:checked', '#form-create-customer').val();
            let birth_date = $('input[name=birth_date]').val();
            let description = $('#description').val();
            let time_doctor_id = $('input[name=time_doctor_id]').val();
            let price = $('input[name=price]').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url(route('user.customer.store')) }}",
                data: {
                    'name_booking': name_booking,
                    'phone_booking': phone_booking,
                    'name_patient': name_patient,
                    'phone_patient': phone_patient,
                    'email': email,
                    'birth_date': birth_date,
                    'description': description,
                    'gender': gender,
                    'time_doctor_id': time_doctor_id,
                    'price': price,
                },
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    $('#modal-create-customer').modal('hide');
                    console.log(data);
                    //Notification
                    $.toast({
                        heading: 'Chúc mừng',
                        text: 'Bạn đã đăng kí thành công!',
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                    renderDateAvailable();
                },
            });
        }

        $( document ).ready(function() {
            renderDateAvailable();
            //On change input date
            $('#date').on('change', function () {
                renderDateAvailable();
            });

            //Close modal create customer
            $(document).keydown(function(e) {
                let code = e.keyCode || e.which;
                if (code == 27) $("#modal-create-customer").modal('hide');
            });

            //Date picker
            let dateOffset = (24*60*60*1000) * 5; //5 days
            let currentDate = new Date();
            currentDate.setTime(currentDate.getTime() - dateOffset);
            $( "#date" ).datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: currentDate,
                showAnim: "fold",
            });

            //Validate birth_date
            let now = new Date();
            $( "#datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd',
                maxDate: now,
                showAnim: "fold",
            });

            //Validate form create customer
            $("#form-create-customer").validate({
                rules: {
                    name_patient: "required",
                    phone_patient: {
                        required: true,
                        number: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    description: "required",
                    birth_date: "required"
                },
                messages: {
                    name_patient: "Vui lòng nhập tên",
                    email: {
                        required: "Vui lòng nhập email",
                        email: "Email của bạn chưa đúng",
                    },
                    phone_patient: {
                        required: "Vui lòng nhập số điện thoại",
                        number: "Trường này phải là số",
                    },
                    description: "Vui lòng nhập tình trạng sức khỏe",
                    birth_date: "Vui lòng chọn ngày sinh",
                },
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    error.addClass( "help-block" );

                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<span class='fa-sharp fa-solid fa-check form-control-feedback'></span>" ).insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
                },
                submitHandler: function () {
                    createAppointment();
                }
            });
        })
    </script>
@endpush

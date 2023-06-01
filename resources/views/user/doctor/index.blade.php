@extends('user.layout.master')
@section('content')
    <div style="padding: 20px;">
        <div class="row">
            <div class="header header-raised header-rose text-center"
                 style="display: flex; justify-content: space-between; align-items: center;">
                <div class="col-md-5" style="display: flex; align-items: flex-end; padding-left: 0">
                    <h2 style="margin: 0">
                        Bác sĩ
                    </h2>
                </div>
                <div class="col-md-2" style="display: flex; align-items: center;">
                    <div class="form-group form-rose is-empty">
                        <input type="text" class="form-control" placeholder="Search"
                               value="" name="name">
                        <span class="material-input"></span>
                    </div>
                    <a id="search_btn" class="btn btn-rose btn-raised btn-fab btn-fab-mini">
                        <i class="material-icons">search</i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="col-md-12 col-lg-12">
                    <div id="order-by-price">
                        <h4 class="card-title">Sắp xếp</h4>
                        <div class="form-group">
                            <select class="select-order-by-price form-control" name="orderValue">
                                <option value="desc">Cao - Thấp</option>
                                <option value="asc">Thấp - Cao</option>
                            </select>
                        </div>
                    </div>
                    <h4 class="card-title">Lọc</h4>
                    {{-- Search Free And Price Doctor --}}
                    <div class="form-filter">
                        <div class="form-group">
                            <label style="font-weight: 600;">Tầm giá</label>
                            <input type="hidden"
                                   name="min_price"
                                   value="{{ $min_price }}"
                                   id="input_min_price"
                            >
                            <input type="hidden"
                                   name="max_price"
                                   value="{{ $max_price }}"
                                   id="input_max_price"
                            >
                            <div class="panel-body panel-refine">
                                <span class="pull-left" data-currency="đ">
                                    <span id="price-left">{{ $min_price }}</span>
                                </span>
                                <span class="pull-right" data-currency="đ">
                                    <span id="price-right">{{ $max_price }}</span>
                                </span>
                                <div class="clearfix"></div>
                                <div id="sliderRefine" class="slider slider-rose noUi-target noUi-ltr noUi-horizontal">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: 600;">Chuyên khoa</label>
                            <select class="form-control" name="select-specialist" id="select-specialist">
                                @foreach($specialists as $specialist)
                                    <option value="{{ $specialist->id }}">{{ $specialist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label-control" style="font-weight: 600;">Chọn ngày</label>
                            <input id="datepicker" type="text" class="form-control datepicker" name="date" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="label-control" style="font-weight: 600;">Chọn giở</label>
                            <input class="form-control timepicker" name="time_start" type="time" value="08:00:00">
                            <input class="form-control timepicker" name="time_end" type="time" value="22:00:00">
                        </div>
                        <a  id="filter" class="btn-filter btn btn-square btn-rose col-md-12">Lọc</a>
                        <a  id="remove_filter" class="btn-filter btn btn-square btn-rose col-md-12">Bỏ lọc</a>
                    </div>
                </div>
            </div>
            <div id="show_doctor" class="col-md-10">
                    @include('user.doctor.doctor-pagination');
            </div>
        </div>
        @endsection
        @push('js')
            <script src="{{ asset('js/nouislider.min.js') }}" type="text/javascript"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="{{ asset('/js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
            <script>
                //Get more doctors function
                function getMoreDoctors(
                        page, date, time_start, time_end, orderValue, specialist, min_price, max_price, searchVal
                ) {
                    searchVal = $('input[name="name"]').val();
                    $.ajax({
                        url: "{{ route('doctor.get_more_doctors') }}",
                        type: 'GET',
                        data: {
                            'date': date,
                            'time_start': time_start,
                            'time_end': time_end,
                            'orderValue': orderValue,
                            'page': page,
                            'specialist': specialist,
                            'min_price': min_price,
                            'max_price': max_price,
                            'name': searchVal,
                        },
                        success: function (data) {
                            $('#show_doctor').html(data);
                        }
                    });
                }

                $(document).ready(function () {
                    
                    $( "#datepicker" ).datepicker({
                        dateFormat: 'yy-mm-dd',
                        minDate: 0,
                        showAnim: "fold",
                    });
                    //get value from url send to input
                    var min_price = window.location.href.indexOf("min_price=") === -1 ? "1000" : window.location.href.split('min_price=').pop().split('&')[0];
                    var max_price = window.location.href.indexOf("max_price=") === -1 ? "10000" : window.location.href.split('max_price=').pop().split('&')[0];
                    var orderValue = window.location.href.indexOf("orderValue=") === -1 ? "desc" : window.location.href.split('orderValue=').pop().split('&')[0];
                    var date = window.location.href.indexOf("date=") === -1 ? $('input[name="date"]').val() : window.location.href.split('date=').pop().split('&')[0];
                    var time_start = window.location.href.indexOf("time_start=") === -1 ? "08:00:00" : window.location.href.split('time_start=').pop().split('&')[0].replaceAll('%3A',':');
                    var time_end = window.location.href.indexOf("time_end=") === -1 ? "20:00:00" : window.location.href.split('time_end=').pop().split('&')[0].replaceAll('%3A',':');
                    var specialist = window.location.href.indexOf("specialist=") === -1 ? "" : window.location.href.split('time_end=').pop().split('&')[0].replaceAll('%3A',':');
                    var name = window.location.href.indexOf("name=") === -1 ? $('input[name="name"]').val() : window.location.href.split('name=').pop().split('&')[0];

                    $('.select-order-by-price').val(orderValue).change();
                    $('#select-specialist').val(specialist).change();
                    $('input[name="date"]').val(date).change();
                    $('input[name="time_start"]').val(time_start).change();
                    $('input[name="time_end"]').val(time_end).change();
                    $('input[name="min_price"]').val(min_price).change();
                    $('input[name="max_price"]').val(max_price).change();
                    $('input[name="name"]').val(name).change();

                    let dateVal;
                    let time_startVal;
                    let time_endVal;
                    let orderValueVal;
                    let specialistVal;
                    let min_priceVal;
                    let max_priceVal;
                    let searchVal;

                    //Listen event click on filter button
                    $('#filter').click(function () {
                        dateVal = $('input[name="date"]').val();
                        time_startVal = $('input[name="time_start"]').val();
                        time_endVal = $('input[name="time_end"]').val();
                        orderValueVal = $('.select-order-by-price').val();
                        specialistVal = $('#select-specialist').val();
                        min_priceVal = $('input[name="min_price"]').val();
                        max_priceVal = $('input[name="max_price"]').val();
                        getMoreDoctors(1, dateVal, time_startVal, time_endVal, orderValueVal, specialistVal, min_priceVal, max_priceVal, searchVal);
                    })

                    //Listen event click on filter button
                    $('#remove_filter').click(function () {
                        dateVal = null;
                        time_startVal = null;
                        time_endVal = null;
                        orderValueVal = null;
                        specialistVal = null;
                        min_priceVal = null;
                        max_priceVal = null;
                        getMoreDoctors(1, dateVal, time_startVal, time_endVal, orderValueVal, specialistVal, min_priceVal, max_priceVal, searchVal);
                    })

                    //Listen event click on search button
                    $('#search_btn').click(function () {
                        searchVal = $('input[name="name"]').val();
                        getMoreDoctors(1, dateVal, time_startVal, time_endVal, orderValueVal, specialistVal, min_priceVal, max_priceVal, searchVal);
                    })

                    $(document).on("click", ".pagination a", function (e) {
                        e.preventDefault();
                        var page = $(this).attr('href').split('page=')[1];
                        getMoreDoctors(page, dateVal, time_startVal, time_endVal, orderValueVal, specialistVal, min_priceVal, max_priceVal, searchVal);
                    });

                    //======= Price filter =======
                    const slider2 = document.getElementById('sliderRefine');

                    const minPrice = parseInt($('#input_min_price').val());
                    const maxPrice = parseInt($('#input_max_price').val());

                    const priceLeft = $('#price-left');
                    const priceRight = $('#price-right');

                    const priceMinVal = parseInt(priceLeft.text());
                    const priceMaxVal = parseInt(priceRight.text());

                    noUiSlider.create(slider2, {
                        start: [priceMinVal, priceMaxVal],
                        connect: true,
                        step: 500,
                        range: {
                            'min': [{{ $configs['filter_min_price'] }} - 1000],
                            'max': [{{ $configs['filter_max_price'] }} + 2000]
                        }
                    });

                    let val;
                    slider2.noUiSlider.on('update', function (values, handle) {
                        val = Math.round(values[handle]);
                        if (handle) {
                            $('#price-right').text(val);
                            $('#input_max_price').val(val);
                        } else {
                            $('#price-left').text(val);
                            $('#input_min_price').val(val);
                        }
                    });
                });
            </script>
    @endpush

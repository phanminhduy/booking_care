<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon.pn') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Dashboard - {{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="viewport" content="width=device-width">
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/material-dashboard.css') }}" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @stack('css')
</head>

<body>
<div class="wrapper">
    @include('admin.layout.sidebar')
    <div class="main-panel">
        @include('admin.layout.topbar')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @if ($errors->any())
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="col-12">
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="col-12">
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        </div>
                    @endif
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    @include('admin.layout.footer')
</div>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/material.min.js') }}"></script>
<script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<script src="{{ asset('js/arrive.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/chartist.min.js') }}"></script>
<script src="{{ asset('js/jquery.bootstrap-wizard.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/jquery.select-bootstrap.js') }}"></script>
<script src="{{ asset('js/sweetalert2.js') }}"></script>
<script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
<script src="{{ asset('js/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/jquery.tagsinput.js') }}"></script>
<script src="{{ asset('js/material-dashboard.js') }}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
<script>
    $(function () {
        let path = window.location.href.split('/').slice(0,5).join('/');
        path = path.split('?')[0];
        $('ul a').each(function () {
            if (this.href === path) {
                $(this).parent('li').addClass('active');
            }
        });
    })
</script>

@stack('js')
</body>

</html>

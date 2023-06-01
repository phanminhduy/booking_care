<html lang="en" class="perfect-scrollbar-on">

<head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Register - {{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="viewport" content="width=device-width">
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/material-dashboard.css') }}" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<body class="off-canvas-sidebar">
    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=" {{ route('home') }} ">Material Dashboard Pro</a>
            </div>

        </div>
    </nav>
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" filter-color="black" data-image="../../assets/img/login.jpeg">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">

                            <div class="card card-signup" style="padding: 30px 0;">
                                <h2 class="card-title text-center">Register</h2>
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-1">
                                        <div class="info info-horizontal">
                                            <div class="icon icon-rose">
                                                <i class="material-icons">timeline</i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">Marketing</h4>
                                                <p class="description">
                                                    We've created the marketing campaign of the website. It was a very
                                                    interesting collaboration.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="info info-horizontal">
                                            <div class="icon icon-primary">
                                                <i class="material-icons">code</i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">Fully Coded in HTML5</h4>
                                                <p class="description">
                                                    We've developed the website with HTML5 and CSS3. The client has
                                                    access to the code using GitHub.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="info info-horizontal">
                                            <div class="icon icon-info">
                                                <i class="material-icons">group</i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">Built Audience</h4>
                                                <p class="description">
                                                    There is also a Fully Customizable CMS Admin Dashboard for this
                                                    product.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="social text-center">
                                            <button class="btn btn-just-icon btn-round btn-twitter">
                                                <i class="fa fa-twitter"></i>
                                            </button>
                                            <button class="btn btn-just-icon btn-round btn-dribbble">
                                                <i class="fa fa-dribbble"></i>
                                            </button>
                                            <button class="btn btn-just-icon btn-round btn-facebook">
                                                <i class="fa fa-facebook"> </i>
                                            </button>
                                            <h4> or be classical </h4>
                                        </div>

                                        <form class="form" method="" action="">
                                            <div class="card-content">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">face</i>
                                                    </span>
                                                    <div class="form-group is-empty"><input type="text"
                                                            class="form-control" placeholder="First Name..."><span
                                                            class="material-input"></span></div>
                                                </div>

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">email</i>
                                                    </span>
                                                    <div class="form-group is-empty"><input type="text"
                                                            class="form-control" placeholder="Email..."><span
                                                            class="material-input"></span></div>
                                                </div>

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">lock_outline</i>
                                                    </span>
                                                    <div class="form-group is-empty"><input type="password"
                                                            placeholder="Password..." class="form-control"><span
                                                            class="material-input"></span></div>
                                                </div>

                                                <!-- If you want to add a checkbox to this form, uncomment this code -->

                                                <div class="checkbox" style="margin-left: 20px;">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes" checked=""><span
                                                            class="checkbox-material check"></span>
                                                        I agree to the <a href="#something">terms and conditions</a>.
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="footer text-center">
                                                <a href="#pablo" class="btn btn-rose btn-round">Get Started</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <div class="copyright pull-right">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>2022, made with <i class="fa fa-heart heart"></i> by <a
                            href="http://www.creative-tim.com" target="_blank">Clinic</a>
                    </div>
                </div>
            </footer>
            <div class="full-page-background" style="background-image: url({{ asset('img/bg8.jpg') }})"></div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/material.min.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

    <!-- Forms Validations Plugin -->
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>


    <!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
    <script src="{{ asset('js/bootstrap-notify.js') }}"></script>
    <!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="{{ asset('js/material-dashboard.js') }}"></script>

</body>

</html>

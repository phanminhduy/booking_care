<div class="header-2">
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://www.creative-tim.com">Clinic</a>
            </div>

            <div class="collapse navbar-collapse" id="navigation-example">
                <ul class="nav navbar-nav navbar-center">
                    <li>
                        <a href="{{ route('user.home') }}">
                            Trang chủ
                        </a>
                    </li>
                    <li>
                        <a href="#pablo">
                            Giới thiệu
                        </a>
                    </li>
                    <li>
                        <a href="#pablo">
                            Liện hệ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('doctor') }}">
                             Bác sĩ
                        </a>
                    </li>
                    @if(auth()->guard('doctor')->check())
                    <li>
                        <a href="{{ route('doctor.workSchedule')}}">
                            Xem lịch làm việc
                        </a>
                    </li>
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="material-icons">person</i>
                            <p class="hidden-lg hidden-md">
                                User
                                <b class="caret"></b>
                            </p>
                        </a>
                        <ul class="dropdown-menu">
                            @if( auth()->guard('doctor')->check() )
                                <li>
                                    <a href="{{ route('doctor.info')}}">Thông tin cá nhân</a>
                                </li>
                                <li>
                                    <a href="{{route('doctor.logout')}}">Đăng xuất</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{route('doctor.login')}}">Đăng nhập</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li class="separator hidden-lg hidden-md"></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="page-header header-filter" style="background-image: url('{{ asset('img/doctor1.jpg') }}'); margin-bottom: -400px;">
    </div>
</div>

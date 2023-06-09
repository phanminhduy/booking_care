@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="{{ route('admin.employee.update',$employee) }}" class="form-horizontal"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Sủa thông tin nhân viên</h4>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Họ và tên</label>
                            <div class="col-sm-10">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="text" class="form-control" name="name" value="{{$employee->name}}">
                                    <span class="help-block">A block of help text that breaks onto a new line.</span>
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Ngày sinh</label>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="form-group">
                                            <label class="label-control">Date Picker</label>
                                            <input type="date" class="form-control datepicker" name="birth_date"
                                                   value="{{$employee->birth_date}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 label-on-right">Giới tính</label>
                            <div class="col-sm-10 checkbox-radios">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender"
                                               @if($employee->gender===1)
                                               checked
                                               @endif
                                               value="1"
                                        >
                                        <span class="circle"></span><span class="check"></span> Nam
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender"
                                               @if($employee->gender===0)
                                               checked
                                               @endif
                                               value="0"
                                        >
                                        <span class="circle"></span><span class="check"></span> Nữ
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Ảnh đại diện</label>
                            <div class="col-md-3 col-sm-4">
                                <div class="fileinput text-center fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail img-circle">
                                        <img src="{{asset('storage/'.$employee->avatar)}}" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail img-circle" style=""></div>
                                    <div>
                                                    <span class="btn btn-round btn-rose btn-file">
                                                        <span class="fileinput-new">Add Photo</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="hidden" value="" name="">
                                                        <input type="file" name="avatar">
                                                    <div class="ripple-container"></div></span>
                                        <br>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                           data-dismiss="fileinput"><i class="fa fa-times"></i> Remove
                                            <div class="ripple-container">
                                                <div class="ripple ripple-on ripple-out"
                                                     style="left: 69px; top: 12.6875px; background-color: rgb(255, 255, 255); transform: scale(15.5484);"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 label-on-right">Email</label>
                            <div class="col-sm-10">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="email" class="form-control" name="email" value="{{$employee->email}}">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
{{--                        <div class="row">--}}
{{--                            <label class="col-sm-2 label-on-right">Mật khẩu</label>--}}
{{--                            <div class="col-sm-10">--}}
{{--                                <div class="form-group label-floating is-empty">--}}
{{--                                    <label class="control-label"></label>--}}
{{--                                    <input type="password" class="form-control" name="password" value="{{$employee->password}}">--}}
{{--                                    <span class="material-input"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Số điện thoại</label>
                            <div class="col-sm-10">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="phone" class="form-control" name="phone" value="{{$employee->phone}}">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Địa chỉ</label>
                            <div class="col-sm-10">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="text" class="form-control" name="address" value="{{$employee->address}}">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Vai trò</label>
                            <div class="col-sm-10">
                                <br>
                                @foreach($roles as $role => $val)
                                    <div class="col-sm-10">
                                        <input
                                                type="radio"
                                                id="{{ $role }}"
                                                name="role"
                                                class="custom-control-input"
                                                value="{{ $val }}"
                                                @if($employee->role === $val)
                                                checked
                                                @endif

                                        >
                                        <label class="custom-control-label" for="{{ $role }}">
                                            {{ \App\Enums\UserRoleEnum::getKeyByValue($val) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-rose btn-fill">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

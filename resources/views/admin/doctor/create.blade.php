@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="{{ route('admin.doctor.store') }}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Thêm bác sĩ</h4>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Họ và tên</label>
                            <div class="col-sm-10">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="text" class="form-control" name="name">
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
                                            <input type="date" class="form-control datepicker" name="birth_date" />
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
                                        <input type="radio" name="gender" checked="true" value="1">
                                        <span class="circle"></span><span class="check"></span> Nam
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" value="0">
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
                                        <img src="{{ asset('/img/apple-icon.png') }}" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail img-circle" style="">
                                    </div>
                                    <div>
                                        <span class="btn btn-round btn-rose btn-file">
                                            <span class="fileinput-new">Add Photo</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="hidden" value="" name="">
                                            <input type="file" name="avatar">
                                            <div class="ripple-container"></div>
                                        </span>
                                        <br>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                            data-dismiss="fileinput"><i class="fa fa-times"></i> Remove
                                            <div class="ripple-container">
                                                <div class="ripple ripple-on ripple-out"
                                                    style="left: 69px; top: 12.6875px; background-color: rgb(255, 255, 255); transform: scale(15.5484);">
                                                </div>
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
                                    <input type="email" class="form-control" name="email">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Mật khẩu</label>
                            <div class="col-sm-10">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="password" class="form-control" name="password">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Số điện thoại</label>
                            <div class="col-sm-10">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="phone" class="form-control" name="phone">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Quốc tịch</label>
                            <div class="col-sm-10">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="text" class="form-control" name="nationality">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Địa chỉ</label>
                            <div class="col-sm-10">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="text" class="form-control" name="address">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Bằng cấp</label>
                            <div class="col-sm-10">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="text" class="form-control" name="degree">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Kinh nghiệm</label>
                            <div class="col-sm-10">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="text" class="form-control" name="experience">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 label-on-right">Chuyên ngành</label>

                            <div class="col-lg-5 col-md-6 col-sm-3">
                                <select class="selectpicker" data-style="btn btn-primary btn-round"
                                    title="Chọn chuyên ngành" data-size="7" name="specialist_id">
                                    @foreach ($specialists as $specialist)
                                        <option value="{{ $specialist->id }}">
                                            {{ $specialist->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 label-on-right">Giá khám</label>
                            <div class="col-sm-10">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input type="text" class="form-control" name="price">
                                    <span class="material-input"></span>
                                </div>
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

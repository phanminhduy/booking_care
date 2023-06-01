@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <form id="RegisterValidation" method="post" action="{{ route('admin.employee.changePassword',\Illuminate\Support\Facades\Auth::id()) }}" class="form-horizontal"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Đổi mật khẩu</h4>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group label-floating">
                                    <label class="control-label">
                                        Mật khẩu cũ
                                        <small>*</small>
                                    </label>
                                    <input class="form-control" name="old_password"  type="password" required="true" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group label-floating">
                                    <label class="control-label">
                                        Mật khẩu mới
                                        <small>*</small>
                                    </label>
                                    <input class="form-control" name="new_password" id="registerPassword" type="password" required="true" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group label-floating">
                                    <label class="control-label">
                                        Mật khẩu mới
                                        <small>*</small>
                                    </label>
                                    <input class="form-control" name="password_confirmation" id="registerPasswordConfirmation" type="password" required="true" equalTo="#registerPassword" />
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
@push('js')
    <script type="text/javascript">
        function setFormValidation(id) {
            $(id).validate({
                errorPlacement: function(error, element) {
                    $(element).closest('div').addClass('has-error');
                }
            });
        }

        $(document).ready(function() {
            setFormValidation('#RegisterValidation');
            setFormValidation('#TypeValidation');
            setFormValidation('#LoginValidation');
            setFormValidation('#RangeValidation');
        });
    </script>
@endpush

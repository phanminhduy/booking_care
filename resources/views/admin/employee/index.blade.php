@extends('admin.layout.master')
@section('content')
    <a class="btn btn-success" href="{{ route('admin.employee.create') }}">
        Thêm
    </a>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Quản lý bác sĩ</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <caption class=" col-md-offset-4">
                                <form >
                                    Search: <input type="search" name="q" value="{{$search}}" style="height: 40px; width: 300px">
                                </form>
                            </caption>
                            <thead class="text-primary">
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Tuổi</th>
                                <th>Giới tính</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Sửa</th>
                                <th>Xoá</th>
                                <th>Đặt lại mật khẩu</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>
                                        {{ $employee->id }}
                                    </td>
                                    <td>
                                        {{ $employee->name }}
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $employee->avatar) }}">
                                    </td>
                                    <td>
                                        {{ $employee->Age }}
                                    </td>
                                    <td>
                                        {{ $employee->GenderName }}
                                    </td>
                                    <td>
                                        {{ $employee->phone }}
                                    </td>
                                    <td>
                                        {{ $employee->email }}
                                    </td>
                                    <td>
                                        {{ \App\Enums\UserRoleEnum::getKeyByValue($employee->role) }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.employee.edit', $employee) }}">
                                            <button class="btn btn-info">Sửa</button>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.employee.destroy', $employee) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" style="margin-top: 25px">Xoá</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.employee.resetPassword', $employee) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-danger" style="margin-top: 25px">Đặt lại mật khẩu</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{ $employees->links('admin.paginator.index') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

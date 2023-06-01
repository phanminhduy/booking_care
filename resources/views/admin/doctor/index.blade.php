@extends('admin.layout.master')
@section('content')
    <a class="btn btn-success" href="{{ route('admin.doctor.create') }}">
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
                                    <th>Tên bác sĩ</th>
                                    <th>Ảnh</th>
                                    <th>Tuổi</th>
                                    <th>Giới tính</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Chuyên ngành</th>
                                    <th>Giá khám</th>
                                    <th>Sửa</th>
                                    <th>Xoá</th>
                                    <th>Đặt lại mật khẩu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                    <tr>
                                        <td>
                                            {{ $doctor->id }}
                                        </td>
                                        <td>
                                            {{ $doctor->name }}
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $doctor->avatar) }}">
                                        </td>
                                        <td>
                                            {{ $doctor->Age }}
                                        </td>
                                        <td>
                                            {{ $doctor->GenderName }}
                                        </td>
                                        <td>
                                            {{ $doctor->phone }}
                                        </td>
                                        <td>
                                            {{ $doctor->email }}
                                        </td>
                                        <td>
                                            {{ $doctor->specialist->name }}
                                        </td>
                                        <td>
                                            {{ $doctor->price }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.doctor.edit', $doctor) }}">
                                                <button class="btn btn-info">Sửa</button>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.doctor.destroy', $doctor) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" style="margin-top: 25px">Xoá</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.doctor.resetPassword', $doctor) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-danger" style="margin-top: 25px">Đặt lại mật khẩu</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{ $doctors->links('admin.paginator.index') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

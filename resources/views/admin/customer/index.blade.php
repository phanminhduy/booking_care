@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Quản lý bệnh nhân</h4>
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
                                <th>Tên bệnh nhân</th>
                                <th>Tuổi</th>
                                <th>Giới tính</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Xem cuộc hẹn</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>
                                        {{ $customer->id }}
                                    </td>
                                    <td>
                                        {{ $customer->name_patient }}
                                    </td>
                                    <td>
                                        {{ $customer->Age }}
                                    </td>
                                    <td>
                                        {{ $customer->GenderName }}
                                    </td>
                                    <td>
                                        {{ $customer->phone_patient }}
                                    </td>
                                    <td>
                                        {{ $customer->email }}
                                    </td>
                                    <td>
                                        <a href="{{route('admin.customer.viewAppointment', $customer)}}">
                                            <button class="btn btn-success">
                                                Xem cuộc hẹn
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{ $customers->links('admin.paginator.index') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Sửa tên chuyên ngành</h4>
                    <form method="post" action="{{route('admin.specialist.update',$specialist)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group label-floating is-empty">
{{--                            <label class="control-label">Tên chuyên ngành</label>--}}
                            <input type="text" class="form-control" name="name" value="{{ $specialist ->name }}">
                            <span class="material-input"></span>
                        </div>
                        <button type="submit" class="btn btn-fill btn-rose">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
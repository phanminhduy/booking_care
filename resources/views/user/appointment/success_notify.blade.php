@extends('user.layout.master')
@section('content')
    <div style="padding: 20px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <h2 class="title">Chúc mừng bạn đã đăng ký thành công.</h2>
            </div>
        </div>
        <div class="row text-center">
            <a href="{{ route('doctor') }}" class="btn btn-rose btn-round">
                <i class="material-icons">explore</i> Quay lại
            </a>
        </div>
    </div>
@endsection
@push('js')
@endpush

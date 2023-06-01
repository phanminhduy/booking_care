@extends('user.layout.master')
@section('content')
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile has-feedback" style="padding-top: 70px; margin-top: 70px;">
                        <div class="avatar">
                            <img src="{{ asset('storage/' . $doctor->avatar) }}" alt="Circle Image"
                                 class="img-circle img-responsive img-raised"
                                 style="
                                     height: 170px;
                                     width: 170px;
                                     object-fit: cover;
                                     object-position: center;
                                     margin: 0 auto;
                                     position: absolute;
                                     top: -50%;
                                     left: 50%;
                                     transform: translatex(-50%);
                                     ">
                        </div>
                        <div class="name text-center" style="width: 30%; margin: 0 auto;">
                            <h3 class="title">{{ $doctor->name }}</h3>
                            <h6 style="color: #ea4c89">{{ $doctor->specialist->name }}</h6>
                            <div style="
                                display: flex;
                                align-items: center;
                                justify-content: space-around;
                                margin-bottom: 12px;
                                font-size: 16px;
                            ">
                                <div style="
                                    display: flex;
                                    align-items: center;
                                ">
                                    <i class="material-icons" style="color: #e91e63;">email</i>
                                    {{ $doctor->email }}
                                </div>
                                <div style="display: flex;align-items: center;">
                                    <i class="material-icons" style="color: #e91e63;">phone</i>
                                    {{ $doctor->phone }}
                                </div>
                            </div>
                            <div class="description text-center">
                                <p>{{ $doctor->degree }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

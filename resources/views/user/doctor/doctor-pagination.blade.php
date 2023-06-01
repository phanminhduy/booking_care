@foreach ($doctors as $doctor)
    <div class="col-md-4">
        <div class="card card-blog">
            <div class="card-image" style="height: auto;">
                <a href="{{ route('user.appointment.create', $doctor) }}">
                    <img src="{{ asset('storage/' . $doctor->avatar) }}"
                         style="width: 100%; height: 250px; object-fit: cover; object-position: center;">
                </a>
                <div class="colored-shadow"
                     style="
                                    background-image: url('{{ $doctor->avatar }}');
                                    opacity: 1;
                                    width: 103%;
                                    height: 255px;">
                </div>
            </div>
            <div class="card-content d-flex flex-column">
                <div class="">
                    <h6 class="category text-rose">{{ $doctor->specialist->name }}</h6>
                </div>
                <div class="">
                    <h4 class="card-title">
                        <a href="{{ route('user.appointment.create', $doctor) }}">{{ $doctor->name }}</a>
                    </h4>
                </div>
                <div class="" style="display: flex; align-items: center; margin-bottom: 12px;">
                    <i class="material-icons" style="font-size: 14px; color: #e91e63;">email</i>
                    {{ $doctor->email }}
                </div>
                <div class="" style="display: flex; align-items: center; margin-bottom: 12px;">
                    <i class="material-icons" style="font-size: 14px; color: #e91e63;">phone</i>
                    {{ $doctor->phone }}
                </div>
                <h3 class="card-title" style="margin: 0;">
                    <span class="text-rose">{{ $doctor->price }}</span> đ
                </h3>
                <div class="">
                    <a href="{{ route('user.appointment.create', ['doctor_id' => $doctor->id, 'date' => $date ?? '']) }}"
                       class="btn btn-rose btn-raised btn-square m-0 col-md-12"
                       style="margin-bottom: 20px;">
                        Đặt hẹn ngay
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="pagination pull-right">
    {{ $doctors->links('user.paginator.index') }}
</div>



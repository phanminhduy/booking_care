<?php

namespace App\Http\Requests\Appointment;

use App\Enums\AppointmentStatusEnum;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Time_doctor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                Rule::in(AppointmentStatusEnum::getArrayView()),
                Rule::unique(Appointment::class)->where(function ($query){
                    return $query->where('status', $this->status)
                        ->where('time_doctor_id', $this->time_doctor_id);
                }),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'unique' => 'Lịch đã bị trùng',
        ];
    }


}

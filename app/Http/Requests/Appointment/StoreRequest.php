<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => [
                'required',
            ],
            'time_doctor_id' => [
                'required',
            ],
            'admin_id' => [
                'required',
            ],
            'description' => [
                'required',
                'string',
            ],
            'price' => [
                'required',
                'int',
            ],
        ];
    }
}

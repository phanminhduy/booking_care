<?php

namespace App\Http\Requests\Specialist;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                'unique:App\Models\Specialist,name',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'unique' => ':attribute đã được dùng',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên chuyên ngành',
        ];
    }
}

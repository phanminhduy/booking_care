<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserRoleEnum;
use App\Models\Admin;
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
            'name' => [
                'bail',
                'required',
                'string',
            ],
            'birth_date' => [
                'required',
                'date',
                'before:today',
            ],
            'avatar' => [
                'nullable',
                'file',
                'image',
            ],
            'email' => [
                'required',
                'string',
                Rule::unique(Admin::class)->ignore($this->employee),
            ],
            'phone' => [
                'nullable',
                'string',
                Rule::unique(Admin::class)->ignore($this->employee),
            ],
            'gender' => [
                'required',
                'boolean',
            ],
            'address' => [
                'required',
                'string',
            ],

            'role' => [
                'required',
                Rule::in(UserRoleEnum::getRole()),
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'unique' => ':attribute đã được dùng',
            'before:today' => ':attribute không hợp lệ',
        ];
    }
}

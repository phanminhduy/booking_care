<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserRoleEnum;
use App\Models\Specialist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
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
            ],
            'password' => [
                'required',
                'string',
                'min:0',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
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
}

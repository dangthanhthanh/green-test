<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'phone' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|confirmed',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Khong dc de trong ^^!',
            'name.min' => 'Nhap gium che 3 ky tu',
            'email.unique' => 'Trung roi !!!',
            'status.required' => 'Khong dc de trong ^^!',
        ];
    }
}

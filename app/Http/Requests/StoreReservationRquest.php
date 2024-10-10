<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRquest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'user_name' => 'required|min:3',
            'user_phone' => ['required', 'regex:/^0[0-9]{9}$/'],
            'guest_count' => 'required|integer|min:1|max:50',
        ];
    }
    public function messages(): array
    {
        return [
            'user_name.required' => 'Tên khách hàng không được để trống!',
            'user_name.min' => 'Tên khách hàng cần chứa tối thiểu 3 kí tự!',
            'user_phone.required' => 'Số điện thoại không được để trống!',
            'user_phone.regex' => 'Sai định dạng số điện thoại!',
            'guest_count.required' => 'Số lượng khách không được để trống!',
            'guest_count.integer' => 'Số lượng khách phải là số nguyên!',
            'guest_count.min' => 'Số lượng khách tối thiểu phải là 1!',
            'guest_count.max' => 'Số lượng khách tối đa là 50!',

        ];
    }
}

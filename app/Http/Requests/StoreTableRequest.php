<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTableRequest extends FormRequest
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
    public function rules()
    {
        return [
            'area' => 'required|string|max:255',
            'table_number' => 'required|integer|unique:tables,table_number', // Ràng buộc unique
            'table_type' => 'required|string|max:255',
            'status' => 'required|in:Available,Reserved,Occupied',
        ];
    }
    public function messages()
    {
        return [
            'table_number.unique' => 'Số bàn đã tồn tại. Vui lòng chọn số khác.',
        ];
    }
}

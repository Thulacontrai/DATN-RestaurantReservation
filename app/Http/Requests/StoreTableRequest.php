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
            'table_number' => 'required|integer|min:1|max:100|unique:tables,table_number', // Giới hạn số bàn từ 1 đến 100
            'table_type' => 'required|string|max:255',
            'status' => 'required|in:Available,Reserved,Occupied',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages()
    {
        return [
            'area.required' => 'Khu vực là bắt buộc.',
            'area.string' => 'Khu vực phải là chuỗi ký tự.',
            'area.max' => 'Khu vực không được vượt quá 255 ký tự.',
            'table_number.required' => 'Số bàn là bắt buộc.',
            'table_number.integer' => 'Số bàn phải là một số nguyên.',
            'table_number.min' => 'Số bàn phải lớn hơn hoặc bằng 1.',
            'table_number.max' => 'Số bàn không được lớn hơn 100.',
            'table_number.unique' => 'Số bàn đã tồn tại. Vui lòng chọn số khác.',
            'table_type.required' => 'Loại bàn là bắt buộc.',
            'table_type.string' => 'Loại bàn phải là chuỗi ký tự.',
            'table_type.max' => 'Loại bàn không được vượt quá 255 ký tự.',
            'status.required' => 'Trạng thái bàn là bắt buộc.',
            'status.in' => 'Trạng thái bàn không hợp lệ. Chỉ chấp nhận các giá trị: Có sẵn, Đã đặt trước, Đang sử dụng.',
        ];
    }
}

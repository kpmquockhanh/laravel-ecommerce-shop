<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'price' => 'required|numeric',
//            'quantity' => 'required',
//            'image' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
//            'title.required' => 'Vui lòng nhập tên',
//            'price.required' => 'Vui lòng nhập giá',
//            'price.numeric' => 'Vui lòng nhập đúng định dạng',
//            'saleoff.min' => 'Giảm giá tối thiểu là 0',
//            'saleoff.max' => 'Giảm giá tối đa là 1',
//            'quantity.required' => 'Vui lòng nhập số lượng',
//            'image.required' => 'Vui lòng chọn ảnh minh họa sản phẩm',
        ];
    }
}

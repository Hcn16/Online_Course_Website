<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'name' => 'required|unique:courses|max:255|min:10',
            'description' => 'required',
            
            'file_path' => 'required',
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Tên không được để trống',
            'name.unique' => 'Tên khóa học bị trùng',
            'name.max' => 'Tên không được quá 255 kí tự',
            'name.min' => 'Tên không được dưới 10 kí tự',
            'description.required' => 'Mô tả  không được để trống',
            'file_path.required' =>'Chưa thêm ảnh'
        ] ;
    }

}

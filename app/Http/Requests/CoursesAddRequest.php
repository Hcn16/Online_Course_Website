<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesAddRequest extends FormRequest
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
            'content' => 'required',
            
            'category_id' => 'required',
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Tên không được để trống',
            'name.unique' => 'Tên khóa học bị trùng',
            'name.max' => 'Tên không được quá 255 kí tự',
            'name.min' => 'Tên không được dưới 10 kí tự',
            'content.required' => 'Mô tả  không được để trống',
            'category_id.required' => 'Danh mục không được để trống'
            
        ] ;
    }
}

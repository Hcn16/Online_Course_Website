<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingAddRequest extends FormRequest
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
            'config_value' => 'required|unique:settings|max:255|min:10',
            'config_key' => 'required',
            
            
        ];
    }

    public function messages(): array{
        return [
            'config_value.required' => 'Tên không được để trống',
            'config_value.unique' => 'Tên khóa học bị trùng',
            'config_value.max' => 'Tên không được quá 255 kí tự',
            'config_value.min' => 'Tên không được dưới 10 kí tự',
            'config_key.required' => ' không được để trống',
           
        ] ;
    }
}

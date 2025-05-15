<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class register_userRequest extends FormRequest
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
             'name' => 'required|max:255|min:10',
             'email' => 'required|',
             'password'=> 'required',
             'file_path' => 'required'
            
             
             
         ];
     }
 
     public function messages(): array{
         return [
             'name.required' => 'Tên không được để trống',
             'name.unique' => 'Tên  bị trùng',
             'email.unique' => 'Email  bị trùng',
             'name.max' => 'Tên không được quá 255 kí tự',
             'name.min' => 'Tên không được dưới 10 kí tự',
             'email.required' => ' không được để trống',
             'password.required' => 'không được để trống',
            
         ] ;
     }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'max:20',
            'email' => 'unique:users',
        ];
    }
    public function messages()
    {
        return [
            'name.max' => '20文字以内で入力してください',
            'email.unique' => '使用済みメールアドレスです',
        ];
    }
}

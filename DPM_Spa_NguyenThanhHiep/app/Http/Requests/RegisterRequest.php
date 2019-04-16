<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "customer_account_name"=>"required",
            "customer_email"=>"required",
            "customer_username"=>"required",
            "customer_identity_card"=>"required",
            "customer_dateofbirth"=>"required",
            "customer_phone"=>"required",
            "customer_password"=>"required",
            "customer_password_confirm" => "required | same:customer_password",
        ];
    }
    public function messages()
    {
        return [
            "customer_account_name.required"=>"Vui lòng nhập tên tài khoản.",
            "customer_email.required"=>"Vui lòng nhập email.",
            "customer_username.required"=>"Vui lòng nhập tên người dùng.",
            "customer_identity_card.required"=>"Vui lòng nhập số cmnn",
            "customer_dateofbirth.required"=>"Vui lòng nhập ngày tháng năm sinh",
            "customer_phone.required"=>"Vui lòng nhập số điện thoại",
            "customer_password.required"=>"Vui lòng nhập mật khẩu.",
            'customer_password_confirm.same' => 'mật khẩu nhập lại chưa khóp! ',
        ];
    }
}

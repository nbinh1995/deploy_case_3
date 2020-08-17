<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CompanyRequest extends FormRequest
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
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'cover_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'c_name' => 'required|string|max:255',
            'address' => 'required',
            'phone' => 'required|regex:/^0[0-9]{9,10}$/',
            'website' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'logo.image' => 'Logo là 1 file ảnh',
            'logo.mimes' => 'Logo phải là định dạng jpeg,png,jpg,gif,svg',
            'logo.max' => 'Logo phải dưới 5000kb',
            'cover_photo.image' => 'Cover_photo là 1 file ảnh',
            'cover_photo.mimes' => 'Ảnh cover_photo phải là định dạng jpeg,png,jpg,gif,svg',
            'cover_photo.max' => 'Ảnh cover_photo phải dưới 5000kb',
            'c_name.required' => ' Tên công ty không được để trống',
            'c_name.max' => 'Tên công ty không được quá 255 kí tự',
            'address.required' => 'Địa chỉ công ty không được để trống',
            'phone.required' => 'Số điện thoại không được bỏ trống',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'website.regex' => 'Website không đúng định dạng',
            'description.required' => 'Thêm mô tả công ty'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json(
                [
                    'errors' => $errors,
                    'code' => 422,
                ],
                200
            )
        );
    }
}

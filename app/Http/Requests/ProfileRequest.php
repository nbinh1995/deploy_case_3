<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'birth' => 'required',
            'cover_letter' =>   'mimes:pdf|max:10000',
            'resume' => 'mimes:pdf|max:10000',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Không được để trống',
            'address.required' => 'Không được để trống',
            'gender.required' => 'Không được để trống',
            'birth.required' => 'Không được để trống',
            'cover_letter.mimes' => 'File không đúng định dạng pdf',
            'cover_letter.max' => 'File quá lớn',
            'resume.mimes' => 'File không đúng định dạng pdf',
            'resume.max' => 'File quá lớn',
            'avatar.mimes' => 'File không đúng định dạng pdf',
            'avatar.max' => 'File quá lớn'
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

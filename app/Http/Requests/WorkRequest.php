<?php

namespace App\Http\Requests;

use App\Rules\CheckStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use App\Rules\SalaryRule;

class WorkRequest extends FormRequest
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
            'company_id' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'require' => 'required',
            'benefit' => 'required',
            'position' => 'required',
            'contact_name' => 'required',
            'contact_phone' => 'required|regex:/^0[0-9]{9,10}$/',
            'contact_email' => 'required|email',
            'type' => 'required',
            'salary_min' => ['numeric', 'min:0', new CheckStatus(request()->input('status')), new SalaryRule(request()->input('salary_max'))],
            'salary_max' => ['numeric', 'min:0', new CheckStatus(request()->input('status'))],
            'last_date' => 'required|date'

        ];
    }

    public function messages()
    {
        return [
            'company_id.required' => 'Không được để trống',
            'title.required' => 'Không được để trống',
            'category_id.required' => 'Không được để trống',
            'description.required' => 'Không được để trống',
            'benefit.required' => 'Không được để trống',
            'position.required' => 'Không được để trống',
            'contact_name.required' => 'Không được để trống',
            'contact_email.required' => 'Không được để trống',
            'contact_phone.required' => 'Không được để trống',
            'type.required' => 'Không được để trống',
            'last_date.required' => 'Không được để trống',
            'contact_phone.regex' => ' Không đúng định dạng',
            'contact_email.email' => 'Không đúng định dạng',
            'last_date.date' => 'Không đúng định dạng',
            'salary_min.numeric' => 'Không đúng kiểu dữ liệu',
            'salary_max.numeric' => 'Không đúng kiểu dữ liệu',
            'salary_min.min' => 'Là số không âm',
            'salary_min.max' => 'Là số không âm'
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

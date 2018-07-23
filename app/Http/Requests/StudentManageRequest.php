<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentManageRequest extends FormRequest
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
        switch ($this->method())
        {
            case ('POST'):
                return [
                    'address' =>'required',
                    'branch_code' => 'required',
                    'code' =>'required|unique:student,code',
                    'course_code' => 'required',
                    'email_address' => 'required|unique:student,email_address',
                    'full_name' => 'required',
                    'province_id' => 'required',
                    'sex' => 'required'
                ];
            case('GET'):
                break;
            case('PATCH'):
            case('PUT'):
                return [

                ];
            case('DELETE'):
                break;
            default:
                return [];
        }
    }
}

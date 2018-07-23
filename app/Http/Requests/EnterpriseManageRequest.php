<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnterpriseManageRequest extends FormRequest
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


                    'name' =>'required',
                    'address' => 'required',
                    'name_president' =>'required',
                    'phone_number' => 'required',
                    'email_address' => 'required|unique:enterprises,email_address',
                    'introduce' => 'required'
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkManageRequest extends FormRequest
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


                    'enterprise_id' =>'required|exists:enterprises,id',
                    'student_code' => 'required|exists:students,code',
                    'rank_id' =>'required|exists:ranks,id',

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

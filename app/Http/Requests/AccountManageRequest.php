<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountManageRequest extends FormRequest
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
            'email' => 'required|email|string|unique:users,email',
            'password' => 'required|min:6|max:30',
            'rep_password' => 'required|same:password',
            'type' => 'required|'.Rule::in([1,2,3])
        ];
        /*switch ($this->method())
    {
        case ('POST'):

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
        return [
            //
        ];*/
    }
}

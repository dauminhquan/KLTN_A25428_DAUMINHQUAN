<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
                    'email' => 'required|email|exists:users,email',
                    'password' => 'required|min:6|max:30',
                    'rep_password' => 'required|same:password',
                    'token' => 'required|exists:users,reset_token'
                ];
            case('GET'):
                return [ 'email' => 'required|email|exists:users,email'];
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

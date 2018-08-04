<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventManageRequest extends FormRequest
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
                    'title' =>'required',
                    'description' => 'required',
                    'content' =>'required',
                    'time_start' => 'required|date',
                    'location' => 'required',
                ];
            case('GET'):
                break;
            case('PATCH'):
            case('PUT'):
                return [
                    'time_start' => 'date',
                ];
            case('DELETE'):
                break;
            default:
                return [];
        }
    }
}

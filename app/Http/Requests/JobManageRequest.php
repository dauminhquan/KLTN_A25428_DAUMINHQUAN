<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobManageRequest extends FormRequest
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
                    'title' => 'required',
                    'location' =>'required',
                    'time_start' => 'required|date',
                    'time_end' => 'required|date',
                    'description' => 'required',
                    'content' => 'required',
                    'salary_id' => 'required',
                    'skills' => 'required|array',
                    'types' => 'required|array',
                    'positions' => 'required|array',
                    'attachment' => 'file'

                ];
            case('GET'):
                break;
            case('PATCH'):
            case('PUT'):
                return [
                    'time_start' => 'date',
                    'time_end' => 'date',
                    'positions' => 'array',
                ];
            case('DELETE'):
                break;
            default:
                return [];
        }
    }
}

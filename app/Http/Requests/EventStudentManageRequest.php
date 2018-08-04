<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventStudentManageRequest extends FormRequest
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
                    'event_id' =>'required|exists:events,id',
                    'student_code' => 'required|exists:students,code|unique:event_student,student_code,NULL,id,event_id,'.$this->request->get('event_id'),
                ];
            case('GET'):
                break;
            case('PUT'):

                return [
                    'id' => 'required|exists:event_student,id',
                    'event_id' =>'exists:events,id',
                    'student_code' => 'exists:students,code|unique:event_student,student_code,'.$this->request->get('id').',id,event_id,'.$this->request->get('event_id'),
                ];
            case('PATCH'):
            case('DELETE'):
                break;
            default:
                return [];
        }
    }
}

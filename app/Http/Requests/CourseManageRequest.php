<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;

class CourseManageRequest extends FormRequest
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
        $course = new Course();
        $course->code = null;
        if($this->has('old_code'))
        {
            $course = Course::find($this->old_code);
        }
        switch ($this->method())
        {
            case ('POST'):
                return [
                    'code' => 'unique:courses,code',
                    'name' => 'required|string|unique:courses,name',
                ];
            case('GET'):
                break;
            case('PATCH'):
            case('PUT'):
                    return [
                        'old_code' => 'exists:courses,code',
                        'code' => 'unique:courses,code,'.$course->code.',code',
                        'name' => 'required|string|unique:courses,name,'.$course->name.',name',
                    ];
            case('DELETE'):
                break;
            default:
                return [];
        }
    }
}

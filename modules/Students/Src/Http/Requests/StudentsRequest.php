<?php

namespace Modules\Students\Src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentsRequest extends FormRequest
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
        $id     = $this->route()->student;

        $rules  = [
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:students,email',
            'password'  => 'required|min:6',
            'phone'     => 'numeric',
            'status'  => ['integer', function($attribute, $value, $fail) {
                if ( $value > 1 ) {
                    $fail(__('students::validation.select'));
                }
            }],
        ];

        if ($id) {
            $rules['email'] = 'required|email|unique:students,email,' .$id;
            if($this->password) {
                $rules['password']  = 'min:6';
            } else {
                unset($rules['password']);
            }
        }
        return $rules;
    }

    public function message()
     {
         return [
             'required'  => __('students::validation.required'),
             'email'     => __('students::validation.email'),
             'unique'    => __('students::validation.unique'),
             'min'       => __('students::validation.min'),
             'max'       => __('students::validation.max'),
             'numeric'   => __('students::validation.integer'),
         ];
      }

     public function attributes()
      {
          return __('students::validation.attributes');

      }
}

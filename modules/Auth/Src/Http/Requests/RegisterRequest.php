<?php

namespace Modules\Auth\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = Auth::guard('students')->id();

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'phone' => 'nullable|numeric|digits:10'
        ];

        if ($id) {
            $rules['email'] = 'required|email|unique:students,email,' .$id;
            if($this->password) {
                $rules['password']  = 'min:6';
                $rules['confirm_password']  = 'same:password';
            } else {
                unset($rules['password']);
                unset($rules['confirm_password']);

            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => __('auth::validation.required'),
            'email' => __('auth::validation.email'),
            'unique' => __('auth::validation.unique'),
            'numeric' => __('auth::validation.numeric'),
            'digits '=> __('auth::validation.digits'),
            'min' =>  __('auth::validation.min'),
            'same' =>  __('auth::validation.same')
        ];
    }

    public function attributes()
    {
        return __('auth::validation.attributes');
    }

}

<?php

namespace Modules\Lessons\Src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
        $rules = [
            'name'          => 'required',
            'slug'          => 'required',
            'parent_id'     => 'required|integer',
            'is_trial'      => 'required|integer',
            'position'      => 'required|integer',
        ];

        if ($this->parent_id !== 0) {
            $rules['parent_id'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required'  => __('lessons::validation.required'),
            'integer'   => __('lessons::validation.integer'),

        ];
    }

    public function attributes()
    {
        return __('lessons::validation.attributes');

    }
}

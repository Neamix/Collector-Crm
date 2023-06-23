<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        return [
            'option' => ['required','exists:settings,option'],
            'value'  => ['required', function ($attribute,$value,$fail) {
                
                // In case that option need to be change is system type check if the value is valid
                if ( $this->option == 'system_type' ) {
                    if ( ! in_array($value,['course_managment_system','book_managment_system']) ) {
                        return $fail(__('validation.not_allowed_value'));
                    }
                }

            }]
        ];
    }
}

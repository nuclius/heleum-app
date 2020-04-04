<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Log;

class SettingsRequest extends FormRequest
{

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
            'hide_name' => 'nullable|boolean',
        ];
        return $rules;
    }

    public function messages()
    {
        // @TODO add custom validation messages here
        return [
            'hide_name' => 'Just check the box ;)',
        ];
    }
}

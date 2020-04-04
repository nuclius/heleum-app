<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Log;

class AddFundsConfirmationRequest extends FormRequest
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
            'selected-currency' => 'required',
            'selected-card-id' => 'required|isValidCard',
            'select-uphold-card' => 'required',
            'select-uphold-amount' => sprintf(
                'required|greaterThanZero|lessThanCardAvailable:%s',
                $this->input('selected-card-id')
            ),
        ];
        return $rules;
    }

    public function messages()
    {
        // @TODO add custom validation messages here
        return [];
    }
}

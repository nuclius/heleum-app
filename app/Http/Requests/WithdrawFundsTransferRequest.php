<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Log;

class WithdrawFundsTransferRequest extends FormRequest
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
            'currency' => 'required',
            'currencyMark' => 'required',
            'selected-card-id' => 'required|isValidCard',
            'amount' => 'required|greaterThanZero|lessThanOrEqualToMaxWithdrawAmount'
        ];
        return $rules;
    }

    public function messages()
    {
        // @TODO add custom validation messages here
        return [];
    }
}

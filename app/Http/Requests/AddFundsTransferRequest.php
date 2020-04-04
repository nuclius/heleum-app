<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Log;

class AddFundsTransferRequest extends FormRequest
{
    // Can't redirect back to where we came from b/c it's
    // only valid for POST routes.  Head back to the uphold card screen.
    // @TODO This will need to be updated when we enable ACH
    protected $redirect = '/add-funds/uphold';

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
            'amount' => sprintf(
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

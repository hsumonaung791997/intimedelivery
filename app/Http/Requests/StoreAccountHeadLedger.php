<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountHeadLedger extends FormRequest
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
        return [
            'account_head_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'postman_name' => 'required',
            'remark' => 'required',
        ];
    }
}

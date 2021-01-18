<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodForm extends FormRequest
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
            'google_user_id' => 'required | integer | min:1',
            'user_review_id' => 'required | integer | min:1',
        ];
    }
}

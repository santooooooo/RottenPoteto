<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfile extends FormRequest
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
            'gmail' => 'required | email',
	    			'name' => 'required | max:255',
						'profile' => 'nullable | max:1000',
//						'icon' => 'nullable | file',
						'best' => 'nullable | max:255',
        ];
    }
}

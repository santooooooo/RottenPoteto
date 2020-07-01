<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputReviewForm extends FormRequest
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
            'contribute_id' => 'required | integer | min:1',
            'google_user_id' => 'required | integer | min:1',
            'title' => 'required | max:255',
            'review' => 'required | max:3000',
	          'spoiler' => 'required | integer | max:1',
            'satisfaction' => 'required | integer | max:5',
            'recommended' => 'required | integer | max:5',
        ];
    }
}

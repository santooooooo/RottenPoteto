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
            'contribute_id' => 'required | integer',
            'google_user_id' => 'required | integer',
            'title' => 'required | max:255',
            'review' => 'required | max:3000',
            'satisfaction' => 'required | integer | min:0 | max:5',
            'recommended' => 'required | integer | min:0 | max:5',
        ];
    }
}

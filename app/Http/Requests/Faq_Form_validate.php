<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Faq_Form_validate extends FormRequest
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
          'email' => 'required',
          'number'=> 'required'
        ];
    }
    public function messages(){
      return [
        'email.required'=> 'Please enter your email',
        'number.required'=> 'Please enter your number'
      ];
    }
}

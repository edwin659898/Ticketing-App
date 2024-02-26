<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
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
        'subject' => 'required',
        'message' => 'required|max:1000',
    ];
    }
    public function messages()
    {
      return [
        'subject.required' => 'Kindly fill the Subject',
        'message.required' => 'Kindly fill the Message',
    ];
    }
}

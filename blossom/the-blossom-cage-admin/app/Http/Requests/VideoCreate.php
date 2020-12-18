<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoCreate extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'en_title' => 'required',
            'ar_title' => 'required',
            'en' => 'required',
            'ar' => 'required',
        ];
    }

    public function messages() {
        return[
            'en_title.required' => 'The english title field is required.',
            'ar_title.required' => 'The arabic title field is required.',
            'en.required' => 'English video url is required',
            'ar.required' => 'Arabic video url is required',
        ];
    }

}

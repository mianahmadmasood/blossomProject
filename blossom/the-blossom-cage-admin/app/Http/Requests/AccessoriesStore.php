<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class AccessoriesStore extends FormRequest {

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

            'en_title' => ['required', Rule::unique('accessories')->where(function ($query) {
                return $query->where('archive', '!=', '1');
            })],
            'ar_title' => ['required', Rule::unique('accessories')->where(function ($query) {
                return $query->where('archive', '!=', '1');
            })],
        ];
    }

}

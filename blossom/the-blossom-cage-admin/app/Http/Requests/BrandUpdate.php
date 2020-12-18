<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandUpdate extends FormRequest {

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

        $id = $this->get('id');

        return [
            'en_title' => ['required', Rule::unique('brands')->where(function ($query) use($id) {
                return $query->where('archive', '!=', '1')->where('id', '!=',$id);
            })],
            'ar_title' => ['required', Rule::unique('brands')->where(function ($query) use($id) {
                return $query->where('archive', '!=', '1')->where('id', '!=',$id);
            })],
        ];
    }

}

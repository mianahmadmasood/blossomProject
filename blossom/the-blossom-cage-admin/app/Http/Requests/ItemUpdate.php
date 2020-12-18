<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdate extends FormRequest {

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

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [
                    ];
                }
            case 'POST': {
                    return [
                        'model' => 'required|unique:items,model,' . $id,
                        'item_code' => 'required|unique:items,item_code,' . $id,
                        'category_id' => 'required',
                        'sub_category_id' => 'required',
                        'en_title' => 'required',
                        'ar_title' => 'required',
                        'en_description' => 'required',
                        'ar_description' => 'required',
//                        'quantity' => 'required|numeric|min:1',
//                        'cart_quantity' => 'required|numeric|lte:quantity',
                        'cart_quantity' => 'required|numeric',
                        'price' => 'required|numeric|min:1',
                        'ar_short_description' => 'required',
                        'en_short_description' => 'required',
                    ];
                }
            default:break;
        }
    }

}

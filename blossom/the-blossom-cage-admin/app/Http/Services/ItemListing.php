<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of ItemListing
 *
 * @author qadeer
 */
use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;

class ItemListing extends Config {

    /**
     * getCategoriesItems method
     * @param type $uuid
     * @return type
     */
    public function getCategoriesItems($uuid) {

        $request_params = Input::all();
        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $category = $this->getCategoryModel()->getCategoryByColumnValue('uuid', $uuid);
        if (empty($category)) {
            return redirect()->back()->with('error_message', 'Sorry! No records found.');
        }
        $items = $this->getItemModel()->getItemsForCategoriesByColumValue('category_id', $category->id, $searchText);
        if (empty($items) || $items->isEmpty()) {
            return redirect()->back()->with('error_message', 'Sorry! No records found.');
        }
        return view('pages.items.category_items', compact('items', 'searchText', 'category'));
    }

}

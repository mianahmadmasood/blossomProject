<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

/**
 * Description of ResponseItemSingle
 *
 * @author qadeer
 */

use App\Http\Responses\BaseResponse;
use Illuminate\Database\Eloquent\Model;

class ResponseItemSingle extends BaseResponse
{

    protected $item;
    protected $lang;

    function __construct(Model $item, string $lang)
    {

        $this->item = $item;
        $this->lang = $lang;
    }

    /**
     * preapreResponseSinle method
     * prepare response for single item
     * @return type
     */
    public function preapreResponseSinle()
    {

        $response = [];
        $brand_ar = !empty($this->item->brand->ar_title) ? $this->item->brand->ar_title : null;
        $brand_en = !empty($this->item->brand->en_title) ? $this->item->brand->en_title : null;
        $response['uuid'] = $this->item->uuid;
        $response['title'] = $this->lang == 'ar' ? $this->item->ar_title : $this->item->en_title;
        $response['en_title'] = $this->item->en_title;
        $response['ar_title'] = $this->item->ar_title;
        $response['slug'] = $this->item->slug;
        $response['short_info'] = $this->lang == 'ar' ? $this->item->ar_description : $this->item->en_description;
        $response['info'] = $this->lang == 'ar' ? $this->item->ar_short_description : $this->item->en_short_description;
        $response['brand'] = $this->lang == 'ar' ? $brand_ar : $brand_en;
        $response['is_favorite'] = !empty($this->item->favorites) ? true : false;
        $response['discounted_type'] = !empty($this->item->discounted_type)?$this->item->discounted_type:null;
        $response['discount'] =!empty($this->item->discount)?$this->item->discount:null;

        $response = $this->prepareSpescs($response);
        $response = $this->prepareTechSpescs($response);
        $response = $this->prepareItemsColor($response);
        $response = $this->prepareItemsAccessories($response);
        $response = $this->preparesVariantData($response);
        $response = $this->preparesattributesData($response);
        $response = $this->prepareImagesResponse($response);
        $response = $this->prepareManualData($response);
        $response = $this->prepareVideoData($response);
        $response = $this->prepreCategory($response);
        $response = $this->makeCartData($response);
        $response_message = $this->getMessageData('success', $this->lang)['general_success'];
        $data['item'] = $response;
        return $this->jsonSuccessResponse($response_message, $data);
    }

    /**
     * preparesVariantData method
     * prepares response data for variant
     * @param type $response
     * @return type
     */
    protected function preparesVariantData($response)
    {
        if (!empty($this->item->variant->size)) {
            $response['lenght'] = (double)$this->item->variant->size->lenght > 0 ? (double)$this->item->variant->size->lenght : null;
            $response['height'] = $this->item->variant->size->height;
            $response['width'] = $this->item->variant->size->width;
            $response['orientation_unit'] = $this->lang == 'ar' ? $this->item->variant->size->orientation_unit_ar : $this->item->variant->size->orientation_unit;
            $response['weight'] = $this->item->variant->size->weight;
            $response['weight_unit'] = $this->lang == 'ar' ? $this->item->variant->size->weight_unit_ar : $this->item->variant->size->weight_unit;
        }
        if (!empty($this->item->variant->color)) {
            $response['color'] = $this->lang == 'ar' ? $this->item->variant->color->ar_color_name : $this->item->variant->color->en_color_name;
            $response['color_code'] = $this->item->variant->color->color_code;
        }
        return $response;
    }

    protected function prepareItemsColor($response)
    {
        $counter = 0;
        if ($this->item->colorItems->isNotEmpty()) {
            foreach ($this->item->colorItems as $key => $row) {

                $ItemsColors = $row->id;
                $response['ItemsColors'][$counter]['id'] = $row->id;
                $response['ItemsColors'][$counter]['color'] = $this->lang == 'ar' ? $row->ar_color_name : $row->en_color_name;
                $response['ItemsColors'][$counter]['en_color_name'] =  $row->en_color_name;
                $response['ItemsColors'][$counter]['ar_color_name'] = $row->ar_color_name;
                $response['ItemsColors'][$counter]['item_id'] = $row->item_id;
                $response['ItemsColors'][$counter]['item_variant_id'] = $row->item_variant_id;
                $response['ItemsColors'][$counter]['color_quantity'] = $this->prepareItemColorQuantity($row->item_id, $row->id, $row->color_quantity);
                $response['ItemsColors'][$counter]['color_code'] = $row->color_code;
//                    $response['ItemsColors'][$counter]['color_image'] = $row->color_image;
                $response['ItemsColors'][$counter]['color_images'] = $this->prepareItemsColorimage($response, $ItemsColors);
                $counter++;
            }
        }
        return $response;
    }

    protected function prepareItemsAccessories($response)
    {
        $counter = 0;
        if ($this->item->itemAccessories->isNotEmpty()) {
            foreach ($this->item->itemAccessories as $key => $row) {

                $itemAccessorie_data = \App\Accessories::where('id', $row->accessories_id)->where('archive', 0)->first();
                $response['itemAccessories'][$counter]['id'] = $row->id;
                $response['itemAccessories'][$counter]['title'] = $this->lang == 'ar' ? $itemAccessorie_data->ar_title : $itemAccessorie_data->en_title;
                $response['itemAccessories'][$counter]['en_title'] = !empty($itemAccessorie_data->en_title)?$itemAccessorie_data->en_title:"";
                $response['itemAccessories'][$counter]['ar_title'] = !empty($itemAccessorie_data->ar_title)?$itemAccessorie_data->ar_title:"";
                $response['itemAccessories'][$counter]['price'] = $itemAccessorie_data->price;
                $response['itemAccessories'][$counter]['image'] = $itemAccessorie_data->image;
                $response['itemAccessories'][$counter]['must_purchase'] = $row->accessories_status;
                $counter++;
            }
            $keys = array_column($response['itemAccessories'], 'must_purchase');
            array_multisort($keys, SORT_DESC, $response['itemAccessories']);
        }
        return $response;
    }

    protected function prepareItemsColorimage($response, $ItemsColors)
    {
        $counter = 0;
        $responseImage = [];
        if ($this->item->itemColorImages->isNotEmpty()) {
            foreach ($this->item->itemColorImages as $key => $row) {
                if ($ItemsColors == $row->item_colors_id) {
                    $responseImage[$counter] = $row->image;
//                    $responseImage[$counter]['is_default'] = $row->is_default;
                    $counter++;
                }
            }
        }
        return $responseImage;
    }

    protected function preparesattributesData($response)
    {
        if (!empty($this->item->otherunits)) {
            $response['unit_attributes'][0]['id'] = $this->item->otherunits->id;
            $response['unit_attributes'][0]['label'] = $this->lang == 'ar' ? $this->item->otherunits->label_ar : $this->item->otherunits->label_en;
            $response['unit_attributes'][0]['unit'] = $this->lang == 'ar' ? $this->item->otherunits->unit_ar : $this->item->otherunits->unit_en;
            $response['unit_attributes'][0]['value'] = $this->lang == 'ar' ? $this->item->otherunits->value_ar : $this->item->otherunits->value_en;
        }

        return $response;
    }

    /**
     * prepareSpescs method
     * prepare item specs for response
     * @param type $response
     * @return type
     */
    protected function prepareSpescs($response)
    {

        $response['specs'] = NULL;
        if ($this->item->specs->isNotEmpty()) {
            if ($this->lang == 'ar') {
                $specs = $this->item->specs->where('type', 'ar')->first();
                $response['specs'] = $specs->specifications;
            } else {
                $specs = $this->item->specs->where('type', 'en')->first();
                $response['specs'] = $specs->specifications;
            }
        }


        return $response;
    }

    protected function prepareTechSpescs($response)
    {

        $counter = 0;
        if ($this->item->specs->isNotEmpty()) {
            foreach ($this->item->specs as $key => $row) {
                if ($this->lang == $row->type) {
                    $response['techspecs'][$counter]['specs'] = $row->title;
                    $response['techspecs'][$counter]['value'] = $row->value;
                    $response['techspecs'][$counter]['unit'] = $row->unit;
                    $response['techspecs'][$counter]['desp_unit'] = $row->desp_unit;
                    $response['techspecs'][$counter]['desp_unit'] = $row->desp_unit;
                    $counter++;
                }
            }

        }


        return $response;
    }

    /**
     * making cart data
     * @param type $response
     * @return type
     */
    protected function makeCartData($response)
    {

        $cart_quantity = $this->prepareItemQuantity();
        $response['quantity'] = $cart_quantity;
        $response['cart_quantity'] = $cart_quantity <= 0 ? 0 : $cart_quantity <= $this->item->cart_quantity ? $cart_quantity : $this->item->cart_quantity;
        $response['price'] = $this->item->price;
        $response['sale_price'] = !empty($this->item->sale_price) ? $this->item->sale_price : NULL;
//        $response['availability'] = $this->item->availability == 0 || $this->item->archive == 1 || $this->item->is_approved == 0 ? false : true;
        $response['availability'] =  $this->item->archive == 1 || $this->item->is_approved == 0 ? false : true;

        $response['is_sold'] = $response['cart_quantity'] <= 0 ? true : false;
//        $response['is_sold'] = $cart_quantity <= 0 ? true : $cart_quantity == 0 || $this->item->is_sold == 1 ? true : false;

        return $response;
    }

    /**
     * making cart data
     * @param type $response
     * @return type
     */
    protected function makeCartDataForItemColor($row)
    {

        $cart_quantity = $this->prepareItemColorQuantity($row->item_id, $row->id, $row->color_quantity);
        $response['quantity'] = $cart_quantity;

        return $response;
    }

    /**
     *
     * @param type $item
     * @return int
     */
    public function prepareItemQuantity()
    {

        $order_items = new \App\OrderItem();
        $total_sold_item = $order_items->fetchSoldItems($this->item->id);
        $remaining_stock = $this->item->quantity - $total_sold_item;
        if ($remaining_stock <= 0) {
            return 0;
        } elseif ($remaining_stock > 0) {
            return $remaining_stock;
        } else {
            return $this->item->quantity;
        }
    }

    /**
     *
     * @param type $item
     * @return int
     */
    public function prepareItemColorQuantity($item_id, $colorid, $color_quantity)
    {

        $order_items = new \App\OrderItem();
//        $total_sold_item = $order_items->fetchSoldItems($this->item->id);
        $total_sold_item = $order_items->fetchSoldItemsColorQty($item_id, $colorid);
        $remaining_stock = $color_quantity - $total_sold_item;
        if ($remaining_stock <= 0) {
            return 0;
        } elseif ($remaining_stock > 0) {
            return $remaining_stock;
        } else {
            return $color_quantity;
        }
    }

    /**
     * prepareImagesResponse method
     * prepares images response for item response
     * @param type $response
     * @return string
     */
    protected function prepareImagesResponse($response)
    {

        foreach ($this->item->images as $image) {
            $response['images'][] = $image->image;
        }
        return $response;
    }

    /**
     *
     * @param type $response
     */
    protected function prepareManualData($response)
    {

        if ($this->item->manuals->isNotEmpty()) {
            if ($this->lang == 'ar') {
                $file = $this->item->manuals->where('type', 'ar')->first();
                $response['manual'] = $file->file;
                $response['manual_title'] = $file->title;
            } else {
                $file = $this->item->manuals->where('type', 'en')->first();
                $response['manual'] = $file->file;
                $response['manual_title'] = $file->title;
            }
        }
        return $response;
    }

    /**
     *
     * @param type $response
     */
    protected function prepareVideoData($response)
    {
        if ($this->item->videos->isNotEmpty()) {
            if ($this->lang == 'ar') {
                $video = $this->item->videos->where('type', 'ar')->first();
                $response['video_url'] = $video->video;
            } else {
                $video = $this->item->videos->where('type', 'en')->first();
                $response['video_url'] = $video->video;
            }
        }
        return $response;
    }

    /**
     *
     * @param type $response
     * @return type
     */
    protected function prepreCategory($response)
    {
        $response['category_title'] = $this->lang == 'ar' ? $this->item->category->ar_title : $this->item->category->en_title;
        $response['category_slug'] = $this->item->category->slug;
        return $response;
    }

}

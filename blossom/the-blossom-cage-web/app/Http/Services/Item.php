<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of ItemService
 *
 * @author qadeer
 */

use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Auth;

class Item extends Config
{

    protected $headers;

    function __construct()
    {
        if (Auth::check()) {
            $this->headers = [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => Auth::user()->user_token,
                'currency' => Session::get('cur_currency'),
            ];
        } else {
            $this->headers = [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'currency' => Session::get('cur_currency'),
            ];
        }
    }

    /**
     * show method
     * Show item details
     * @param type $slug
     * @return type
     */
    public function show($lang, $slug)
    {
        $related_items = null ;
        $request_data['headers'] = $this->headers;
        $response_items = $this->guzzleRequest('items/' . $slug, 'GET', $request_data);

        if(!empty($response_items)) {
            $request_datas['category'] = $response_items['data']['item']['category_slug'];
            $request_datas['headers'] = $this->headers;
            $url = $this->prepareSearchUrl($request_datas);
            $related_items = $this->guzzleRequest('items' . $url, 'GET', $request_datas);
        }
        if (!$response_items['success']) {
            return redirect()->route('home', ['lang' => session()->get('locale')])->with('error_message', $response_items['message']);
        }

//        dd($related_items['data']['items']);
        $item = $response_items['data']['item'];
        $related_item = $related_items['data']['items'];
        return View('pages.itemDetails', compact('item','related_item'));
    }

    /**
     * filterItems method
     * filters items on the basics of filters
     * @return type
     */
    public function filterItems()
    {

        $request_params = Input::all();



        if (empty($request_params)) {
            return $this->getHomeService()->getCategories();
        }

        if (!empty($request_params['brand'])) {
            if ($request_params['category'] == 'all') {
                $request_data['headers'] = $this->headers;
                $response_cats = $this->guzzleRequest('categories', 'GET', $request_data);
                $response_brands = $this->guzzleRequest('brands', 'GET', $request_data);
            }
            //CHECKING THE Brand AVAILBILITY
            if ( empty($response_brands['data']['brands']) || $response_brands['success'] == false ) {
                return redirect()->route('home', ['lang' => session()->get('locale')])->with('error_message', $this->getMessageData('error', session()->get('locale'))['brand_blocked']);
            }
        } else {
            if (!empty($request_params['category'])) {
                if ($request_params['category'] == 'all') {
                    $request_data['headers'] = $this->headers;
                    $response_cats = $this->guzzleRequest('categories', 'GET', $request_data);
                } else {
                    $request_data['headers'] = $this->headers;
                    $response_cats = $this->guzzleRequest('categories?title=' . $request_params['category'], 'GET', $request_data);
                }
            } else {
                $request_data['headers'] = $this->headers;
                $response_cats = $this->guzzleRequest('categories', 'GET', $request_data);
            }
        }
        //CHECKING THE CATEGRIES AVAILBILITY
        if ($response_cats['success'] == false || empty($response_cats['data']['categories'])) {
            return redirect()->route('home', ['lang' => session()->get('locale')])->with('error_message', $this->getMessageData('error', session()->get('locale'))['category_blocked']);
        }

        $url = $this->prepareSearchUrl($request_params);

        $response_items = $this->guzzleRequest('items' . $url, 'GET', $request_data);


        if (!empty($request_params['sort_by']) && $request_params['sort_by'] != 'id' ) {
            $request_params['page_no'] = 1;
        }

        if (!$response_items['success']) {

            return redirect()->route('searchItem', ['lang' => session()->get('locale')])->with('error_message', $response_items['message']);

//            return $this->pageNotFound($response_items['message']);
        }
        return $this->processResponseForWeb($request_params, $response_cats, $response_items);
    }

    /**
     * processResponseForWeb method
     * prepares and send data to web pages
     * @param type $response_categories
     * @param type $response_items
     * @return type
     */
    public function processResponseForWeb($request_params, $response_categories, $response_items)
    {

        $data['selected_category'] = !empty($request_params['category']) ? $response_categories['data']['categories'][0]['title'] : NULL;
        $data['selected_category_slug'] = !empty($request_params['category']) ? $response_categories['data']['categories'][0]['slug'] : NULL;
        $data['items'] = $response_items['data']['items'];
        $data['count'] = $response_items['data']['count'];
        $data['categories'] = $response_categories['data']['categories'];
        $data['brands'] = $response_categories['data']['brands'];
        if (!empty($request_params['sub_categories'])) {
            $data['selected_categories'] = explode("|", $request_params['sub_categories']);
        }
        if (!empty($request_params['brands'])) {
            $data['selected_brands'] = explode("|", $request_params['brands']);
        }
        if (!empty($request_params['price'])) {
            $data['price'] = $request_params['price'];
        }
        if (!empty($request_params['categories']) && !empty($request_params['price'])) {
            $data['reset'] = true;
        }
        return View('pages.items', compact('data'));
    }

    /**
     *
     * @param type $request_params
     * prepareUrl for get request
     * @return type
     */
    public function prepareSearchUrl($request_params)
    {

        $url = '';
        if (!empty($request_params)) {


            if (!empty($request_params['category'])) {
                if ($request_params['category'] == 'all') {
                    $url = $url . '?category=';
                } else {
                    $url = $url . '?category=' . $request_params['category'];
                }
            }

            if (!empty($request_params['brands'])) {
                $url = $this->prepareBrands($url, $request_params);
            }

            if (!empty($request_params['sub_categories'])) {
                $url = $this->prepareCategories($url, $request_params);
            }
            if (!empty($request_params['price'])) {
                $url = $this->preparePrice($url, $request_params);
            }

            if (!empty($request_params['search'])) {
                $url = $this->prepareSearch($url, $request_params);
            }
            if (!empty($request_params['sort_by'])) {
                $url = $this->prepareSortyBy($url, $request_params);
            }

            if (!empty($request_params['page_no'])) {

                if ($url == '') {
                    $url = $url . '?page_no=' . $request_params['page_no'];
                } else {
                    $url = $url . '&page_no=' . $request_params['page_no'];
                }
            }
        }
        return $url;
    }

    /**
     * prepareCategories method
     * prepares categories
     * @param string $url
     * @param type $request_params
     * @return string
     */
    public function prepareSortyBy($url, $request_params)
    {

        if (!empty($request_params['sort_by'])) {
            $url = $url . '&sort_by=' . $request_params['sort_by'];
        }

        return $url;
    }

    /**
     * prepareCategories method
     * prepares categories
     * @param string $url
     * @param type $request_params
     * @return string
     */
    public function prepareCategories($url, $request_params)
    {


        if ($url == '') {

            $url = $url . '?sub_categories=' . $request_params['sub_categories'];
        } else {
            $url = $url . '&sub_categories=' . $request_params['sub_categories'];
        }

        return $url;
    }

    /**
     * prepareBrands method
     * prepares categories
     * @param string $url
     * @param type $request_params
     * @return string
     */
    public function prepareBrands($url, $request_params)
    {


        if ($url == '') {

            $url = $url . '?brands=' . $request_params['brands'];
        } else {
            $url = $url . '&brands=' . $request_params['brands'];
        }

        return $url;
    }

    /**
     * preparePrice method
     * attach price to url
     * @param type $url
     * @param type $request_params
     * @return string
     */
    public function preparePrice($url, $request_params)
    {

        $price = explode(",", $request_params['price']);
        $lower_bound = (double)$price[0];
        $upper_bound = (double)$price[1];
        if ($price[0] === 0 && $price[1] === 0) {
            return $url;
        }
        if ($url !== '') {
            $url = $url . '&price=' . $lower_bound . ',' . $upper_bound;
        } else {

            $url = $url . '?price=' . $lower_bound . ',' . $upper_bound;
        }
        return $url;
    }

    /**
     * prepareSearch method
     * attaches search to url
     * @param type $url
     * @param type $request_params
     * @return string
     */
    public function prepareSearch($url, $request_params)
    {

        if ($url !== '') {

            $url = $url . '&search=' . $request_params['search'];
        } else {

            $url = $url . '?search=' . $request_params['search'];
        }

        return $url;
    }

    /**
     * prepareSearch method
     * @param type $url
     * @param type $request_params
     * @return string
     */
    public function getFeaturedItem()
    {


        $request_data['headers'] = $this->headers;
        $response_items = $this->guzzleRequest('items/featured/list', 'GET', $request_data);
        $items = array_slice($response_items['data']['items'], 0, 6);
        $imagepath = \URL::to('/') . '/public/assets/images/heart-icon-2.png';
        foreach ($items as $item) {
            $link = \URL::to('/') . '/' . Session::get('locale') . '/product/' . $item['slug'];
            $divs[] = ' <a href="' . $link . '">
                            <div class="cfitem"><img src="' . config('paths.medium_item') . $item['image'] . '"></div>
                            <h4>
                            ' . $item['title']
                . ' <img id="addToFav" width="10" src="' . $imagepath . '">
                            </h4>
                            <p>' . Session::get('cur_currency') . ' ' . $item['price'] * Session::get('amount_per_unit') . '</p>
                        </a>';
        }
        return $this->jsonSuccessResponse($response_items['message'], $divs);
    }

}

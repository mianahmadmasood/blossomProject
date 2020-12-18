<?php



namespace App\Http\Services;


use App\Http\Responses\ResponseHomeFeeds;
use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;

class HomeFeeds extends Config
{

    /**
     * Injecting related response class
     * @return ResponseHomeFeeds
     */
    public function jsonResponse($homefeeds,$homefeedsBrand,$homefeedsCategories,$homefeedsBanners,$homefeedsTrendyItem,$homefeedsAllBrands,$items, $lang,$convertRate,$pageNo)
    {

        return new ResponseHomeFeeds($homefeeds,$homefeedsBrand,$homefeedsCategories,$homefeedsBanners,$homefeedsTrendyItem,$homefeedsAllBrands,$items, $lang,$convertRate,$pageNo);
    }

    /**
     * getItems method
     * list all the items
     * @return type
     */
    public function gethomefeeds()
    {
        $request_params = Input::all();
        $convertRate=1;
        $request_params['user_id'] = null;
        if (!empty($request_params['user'])) {
            $request_params['user_id'] = $request_params['user']['id'];
        }
        if (empty($request_params['page_no'])) {
            $request_params['page_no'] = 1;
        }

        $request_params['limit'] = $this->limits['items_featured_limit'];
        $request_params['offset'] = ($request_params['limit'] * $request_params['page_no']) - $this->limits['items_featured_limit'];

        if (isset($request_params['currency']) && !empty($request_params['currency'])  && $request_params['currency'] == 'USD') {
//            $unit = $this->fixirConverter(1, 'USD', 'SAR');
            $unit = $this->fixirConverter(1, 'SAR', 'USD');
            if($unit['success'] == true ){
                $convertRate=(double)$unit['converted_amount'];
            }
        }

        $homefeeds = $this->getHomeFeedModel()->getnewHomefeeds();
        $homefeedsBanners = $this->getHomeFeedModel()->getHomefeeds('banners');
        $homefeedsTrendyItem = $this->getHomeFeedModel()->getHomefeedstrendyItem('trendy_item');
        $homefeedsBrand = $this->getHomeFeedModel()->getnewHomefeedsForBrand();
        $homefeedsCategories = $this->getCategoryModel()->getParentCategories();
        $homefeedsAllBrands  = $this->getBrandModel()->getBrands();

        $items = $this->getItemModel()->getFeaturedItems($request_params, $request_params['user_id']);

        return $this->jsonResponse($homefeeds,$homefeedsBrand,$homefeedsCategories,$homefeedsBanners,$homefeedsTrendyItem,$homefeedsAllBrands,$items, $request_params['lang'],$convertRate,$request_params['page_no'])->preapreResponse();
    }

}

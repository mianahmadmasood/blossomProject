<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class VerifyApiRequest {

    use \App\Http\Traits\CommonService;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        try {
            $request_params = $request->all();
            $lang = $request->header('lang');
            if (empty($lang)) {

                $lang = 'en';
            }
            $request_api_key = $request->header('apikey');
            $key = explode(':', config('app.key'))[1];
            if ($request_api_key != $key) {
                return $this->jsonErrorResponse("API key is missing or invalid", 403);
            }
            return $this->processHandle($request, $next, $lang);
        } catch (\Exception $ex) {
            return $this->jsonErrorResponse($ex->getMessage(), 403);
        }
    }

    public function processHandle($request, $next, $lang) {
        try {
            if (!empty($request->header('usertoken'))) {
                $user = new \App\User();
                $user_details = $user->where('user_token', $request->header('usertoken'))->first();
                $request->merge(['user' => $user_details]);
            }
            if (!empty($request->header('guestemail'))) {
                $request->merge(['guestemail' => $request->header('guestemail')]);
            }
            if (!empty($request->header('currency'))) {
                $request->merge(['currency' => $request->header('currency')]);
            }
            $request->merge(['lang' => $lang]);
            return $next($request);
        } catch (\Exception $ex) {

            return $this->jsonErrorResponse($ex->getMessage(), 403);
        }
    }

}

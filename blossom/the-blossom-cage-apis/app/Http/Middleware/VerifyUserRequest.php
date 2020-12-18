<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use App\User;

class VerifyUserRequest {

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

            $lang = $request->header('lang');

            if (empty($lang)) {
                $lang = 'en';
            }
            $user_token = $request->header('usertoken');

            if (empty($user_token)) {

                if ($lang == 'ar') {
                    return $this->jsonErrorResponse("يجب عليك مصادقة نفسك قبل الوصول إلى المورد", 401);
                } else {
                    return $this->jsonErrorResponse("You have to authenticate yourself before gaining access to the resource.", 401);
                }
            }

            return $this->processHandle($user_token, $request, $next, $lang);
        } catch (\Exception $ex) {

            return $this->jsonErrorResponse($ex->getMessage(), 403);
        }
    }

    public function processHandle($user_token, $request, $next, $lang) {
        try {

            $user = new User();

            $user_details = $user->where('user_token', $user_token)->first();

            if (empty($user_details)) {

                if ($lang == 'ar') {
                    return $this->jsonErrorResponse("أنت لست مستخدمًا صالحًا في النظام", 401);
                }
                return $this->jsonErrorResponse("You are not valid user in system.", 401);
            }

            if ($user_details->archive == 1) {

                if ($lang == 'ar') {
                    return $this->jsonErrorResponse("تم حظر حسابك بسبب بعض الأسباب", 401);
                }
                return $this->jsonErrorResponse("You account has been blocked due some reasons. Please contact chbibcare", 401);
            }

            $request->merge(['lang' => $lang]);
            $request->merge(['user' => $user_details]);

            return $next($request);
        } catch (\Exception $ex) {

            return $this->jsonErrorResponse($ex->getMessage(), 403);
        }
    }

}

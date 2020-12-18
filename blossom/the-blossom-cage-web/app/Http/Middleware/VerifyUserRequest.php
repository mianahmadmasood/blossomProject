<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Auth;

class VerifyUserRequest
{

    use \App\Http\Traits\CommonService;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if (!Auth::check()) {
                if (session()->get('locale') == 'en') {
                    return redirect()->route('searchItem', ['lang' => session()->get('locale')])->with('error_message', 'You have to authenticate yourself before gaining access to resource.');
                } else {
                    return redirect()->route('searchItem', ['lang' => session()->get('locale')])->with('error_message', 'يجب عليك مصادقة نفسك قبل الوصول إلى المورد');
                }
            }

            return $next($request);
        } catch (\Exception $ex) {

            return $this->jsonErrorResponse($ex->getMessage(), 403);
        }
    }

}

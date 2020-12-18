<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;


class Handler extends ExceptionHandler {

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [

    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception) {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception) {

//        if ($exception instanceof TokenMismatchException){
//            // Redirect to a form. Here is an example of how I handle mine
//            return redirect($request->fullUrl())->with('csrf_error',"Oops! Seems you couldn't submit form for a long time. Please try again.");
//        }
//        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
//            return redirect()->route('home', ['lang' => session()->get('locale')])->with('error_message', 'Oops! Your Validation Token has expired. Please try again');
//        }
//        if ($exception->getCode() == 0) {
//            return redirect()->route('home', ['lang' => session()->get('locale')])->with('error_message', $exception->getMessage());
//        }
        return parent::render($request, $exception);
    }

}

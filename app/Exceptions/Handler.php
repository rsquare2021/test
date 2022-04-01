<?php

namespace App\Exceptions;

use App\Facades\UserRoute;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        $is_csrf_token_mismatch = $exception instanceof TokenMismatchException;
        $is_419_http = $this->isHttpException($exception) && $exception->getStatusCode() == 419;

        if($is_csrf_token_mismatch || $is_419_http) {
            $request->session()->flush();
            if($request->routeIs("admin.*")) {
                return redirect(RouteServiceProvider::ADMIN_HOME);
            }
            elseif($request->routeIs("merchant.*")) {
                return redirect('/merchant/login');
            }
            else {
                return redirect()->route("campaign.login", ["campaign_id" => UserRoute::campaign()->id]);
            }
        }
        return parent::render($request, $exception);
    }
}

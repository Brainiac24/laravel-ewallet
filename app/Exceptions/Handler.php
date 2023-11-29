<?php

namespace App\Exceptions;

use App\Exceptions\Frontend\Api\AccessForbiddenException;
use App\Exceptions\Frontend\Api\LimitException;
use App\Exceptions\Frontend\Api\LogicException;
use App\Exceptions\Frontend\Api\TokenExpiredException;
use App\Exceptions\Frontend\Api\UnauthorizedException;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Exceptions\Frontend\Api\WaitingException;
use App\Services\Common\Helpers\HttpStatusCode;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Support\Facades\App;
use ReallySimpleJWT\Exception\TokenValidatorException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AccessForbiddenException::class,
        LimitException::class,
        ResourceNotFoundException::class,
        //TimeoutException::class,
        TokenExpiredException::class,
        UnauthorizedException::class,
        WaitingException::class,
        ValidationException::class,
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
     * @param Exception $exception
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        if (!$this->shouldntReport($exception)) {
//            if (!App::environment('local')) {
////                Bugsnag::notifyException($exception);
//            }
            \Log::error($exception);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof TokenValidatorException)
            return response()->apiError(['code' => HttpStatusCode::TOKEN_EXPIRED, 'message' => trans('auth.token_expired')]);

        if ($request->expectsJson()) {
            if($exception instanceof MaintenanceModeException)
                return response()->apiError(['code' => HttpStatusCode::SERVICE_UNAVAILABLE, 'message' => trans('auth.service_unavailable')]);
        }

        return parent::render($request, $exception);
    }


    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('admin.access.login'));
    }
}

<?php

namespace App\Http\Middleware\Backend\Filter;

use Closure;
use http\Url;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class RememberSearchFields
{

    /**
     * @var array $exceptRoutes ignore full resource routes or by request->path
     */
    private $exceptRoutes = [
        'remoteIdentification/*',
        //'merchant/index'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('get')){
            $path = $request->path();
            $key = $path ?? 'default';

            /* if (in_array($key . '/*', $this->exceptRoutes) || in_array($path, $this->exceptRoutes)) {
                 return $next($request);
             }*/
            $referrer = $this->clearReferrer($request->headers->get('referer'));


            $current = $request->url();


            $queryString = $request->getQueryString();

            if ($referrer == $current && $queryString) {
                session()->put('filters.' . $key, $queryString);
            } else if ($referrer == $current && !$queryString) {
                session()->forget('filters.' . $key);
            } else if (!$queryString && session()->has('filters.' . $key)) {
                return redirect()->to($current . "?" . session()->get('filters.' . $key));
            }

        }

        return $next($request);
    }

    private function clearReferrer($referrer)
    {
        return rtrim(preg_replace('/\?.*/', '', $referrer));
    }
}

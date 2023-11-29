<?php

namespace App\Providers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->responseApiSuccess();

        $this->responseApiError();
    }

    private function responseApiSuccess()
    {
        \Response::macro('apiSuccess', function ($data = ['code' => 0], $status = 200, $headers = [], $options = null) {

            $response = [];
            //dd($data);
            //$data['message'] = !array_key_exists($status, HttpCodes::$statusTexts) ?  : HttpCodes::$statusTexts[$status];
            !(isset($data['code'])) ?: $response['code'] = $data['code'];
            !(isset($data['message'])) ?: $response['message'] = $data['message'];
            !(isset($data['errors'])) ?: $response['errors'] = $data['errors'];
            !(isset($data['data'])) ?: $response['data'] = $data['data'];
            !(isset($data['meta'])) ?: $response['meta'] = $data['meta'];

            if (isset($data['data']) && isset($data['data']->resource) && $data['data']->resource instanceof LengthAwarePaginator) {
                if ($data['data']->hasPages()) {
                    $response['pagination'] = [
                        'current_page' => $data['data']->currentPage(),
//                        'first_page_url' => $data['data']->url(1),
//                        'last_page_url' => $data['data']->url($data['data']->lastPage()),
//                        'prev_page_url' => $data['data']->previousPageUrl(),
//                        'next_page_url' => $data['data']->nextPageUrl(),
                        'last_page' => $data['data']->lastPage(),
                        //'path' =>
                        'per_page' => $data['data']->perPage(),
                        'total' => $data['data']->total(),
                        'first_item' => $data['data']->firstItem(),
                        'last_item' => $data['data']->lastItem(),
                    ];
                }
            }

            return response()->json($response, $status, $headers, JSON_UNESCAPED_UNICODE);
        });
    }

    private function responseApiError()
    {
        \Response::macro('apiError', function ($data = [], $status = 400, $headers = [], $options = null) {

            $response = [];
            //dd($data);
            //$data['message'] = !array_key_exists($status, HttpCodes::$statusTexts) ?  : HttpCodes::$statusTexts[$status];
            !(isset($data['code'])) ?: $response['code'] = $data['code'];
            !(isset($data['message'])) ?: $response['message'] = $data['message'];
            !(isset($data['errors'])) ?: $response['errors'] = $data['errors'];
            !(isset($data['data'])) ?: $response['data'] = $data['data'];
            !(isset($data['meta'])) ?: $response['meta'] = $data['meta'];

            return response()->json($response, $status, $headers, JSON_UNESCAPED_UNICODE);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

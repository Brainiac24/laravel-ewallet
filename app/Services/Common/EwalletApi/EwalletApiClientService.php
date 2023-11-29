<?php
/**
 * Created by PhpStorm.
 * User: Dilshod Mamadjonov
 * Date: 10.08.2020
 * Time: 11:28
 */

namespace App\Services\Common\EwalletApi;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;

class EwalletApiClientService implements EwalletApiClientServiceContract
{
    /** @var \GuzzleHttp\Client */
    private $http;
    private $logger;

    public function __construct()
    {
        $messageFormats = [
            'REQUEST: ',
            'METHOD: {method}',
            'URL: {uri}',
            'HTTP/{version}',
            'HEADERS: {req_headers}',
            'Payload: {req_body}',
            'RESPONSE: ',
            'STATUS: {code}',
            'BODY: {res_body}',
            "\n"
        ];

        $stack = $this->setLoggingHandler($messageFormats);
        $this->http = new Client(array_merge(config("ewalletapi.GuzzleClientConfig"), ['handler' => $stack]));
    }

    /** @return \GuzzleHttp\Client */
    public function getHttpClient()
    {
        return $this->http;
    }

    private function get_logger()
    {
        if (! $this->logger) {
            $this->logger = with(new Logger('guzzle-log'))->pushHandler(
                new RotatingFileHandler(storage_path('logs/ewallet-api-log.log'))
            );
        }
        return $this->logger;
    }
    /**
     * Setup Middleware
     */
    private function setGuzzleMiddleware(string $messageFormat)
    {
        return Middleware::log(
            $this->get_logger(),
            new MessageFormatter($messageFormat)
        );
    }
    /**
     * Setup Logging Handler Stack
     */
    private function setLoggingHandler(array $messageFormats)
    {
        $stack = HandlerStack::create();
        $mapResponse = Middleware::mapResponse( function(ResponseInterface $response) {
            $response->getBody()->rewind(); return $response;
        });

        collect($messageFormats)->each(function ($messageFormat) use ($stack) {
            // We'll use unshift instead of push, to add the middleware to the bottom of the stack, not the top
            $stack->unshift(
                $this->setGuzzleMiddleware($messageFormat)
            );
        });

        $stack->unshift($mapResponse);

        return $stack;
    }
}
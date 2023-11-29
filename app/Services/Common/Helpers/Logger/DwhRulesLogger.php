<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 03.09.2021
 * Time: 13:58
 */

namespace App\Services\Common\Helpers\Logger;


use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;

class DwhRulesLogger
{

    public function __construct()
    {
        $folder = 'dwhRules';
        $serviceName = 'dwhRules';
        $this->logger = new \Monolog\Logger($serviceName);

        $this->logger->pushHandler(
            (new StreamHandler(sprintf('%s/logs/%s/%s-info-%s.log', storage_path(), $folder, $serviceName,  \Carbon\Carbon::now()->toDateString())))->setFormatter(new LineFormatter(null, null, true, true)));
    }

    public function info($message, array $context = [])
    {
        $this->logger->info($message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->logger->error($message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->logger->warning($message, $context);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.09.2018
 * Time: 11:00
 */

namespace App\Services\Common\Filter;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class QueryFilter
{
    protected $data = [];
    protected $blackList = [];
    protected $query;

    /**
     * QueryFilter constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function apply(Builder $query)
    {
        $this->query = $query;

        foreach ($this->data as $key => $value) {
            $method = Str::camel($key);

            if (count($this->blackList) > 0) {
                if (in_array($method, $this->blackList))
                    continue;
            }

            $this->callUserFunc($method, $value);
        }

        return $query;
    }

    protected function callUserFunc($method, $value)
    {
        if (method_exists($this, $method)) {
            call_user_func([$this, $method], $value);
        }
    }

}
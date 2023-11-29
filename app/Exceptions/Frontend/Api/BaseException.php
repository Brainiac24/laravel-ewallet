<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 16:44
 */

namespace App\Exceptions\Frontend\Api;


abstract class BaseException extends \Exception
{
    protected $attribute = [];

    /**
     * @return array
     */
    public function getAttribute(): array
    {
        return $this->attribute;
    }

    /**
     * @param array $attribute
     */
    public function setAttribute(array $attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }

    abstract protected function getStatusCode();

    abstract protected function getComment();


    public function render()
    {
        count($this->getAttribute()) === 0 ?: $data = $this->getAttribute();

        $data['message'] = ($this->getComment() == null) ? $this->getMessage() : $this->getComment();
        $data['code'] = $this->getStatusCode();

        return response()->apiError($data);
    }
}
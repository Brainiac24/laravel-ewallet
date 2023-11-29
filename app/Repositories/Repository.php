<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 06.04.2017
 * Time: 14:30
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    protected $searchable_fields = [];
    protected $model;

    /**
     * Repository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    protected function applyCriteria($model, $data)
    {

        foreach ($this->searchable_fields as $field) {

            if (isset($data[$field['key_request']]) && (!empty($data[$field['key_request']]) || $data[$field['key_request']] == 0)) {

                $key = $field['key_db'];
                $condition = $field['condition'];
                $value = array_key_exists('pattern', $field) ? str_replace("{{$field['key_request']}}", $data[$field['key_request']], $field['pattern']) : $data[$field['key_request']];

                if (isset($field['raw']) && !empty($field['raw'])) {
                    $key = \DB::raw($field['raw']);
                }

                if (array_key_exists('relation', $field)) {

                    $this->model = $model->whereHas($field['relation'], function ($q) use ($key, $condition, $value) {
                        $q->where($key, $condition, $value);
                    });

                } else {
                    $this->model = $model->where($key, $condition, $value);
                }
            }

        }

        return $this->model;
    }
}
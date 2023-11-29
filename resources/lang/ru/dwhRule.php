<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 01.09.2021
 * Time: 15:36
 */
return [
    'backend' => [
        'title' => 'Правила Dwh',
        'name' => 'Список правил Dwh',
        'table' => [
            'id' => 'ID',
            'table' => 'Название таблицы в БД',
            'job_log_type' => 'Тип записи журнала задач',
            'description' => 'Описание',
            'to_dwh_days' => 'Кол. дней до переноса в Dwh',
            'delete_from_dwh_days' => 'Кол. дней до удаления из Dwh',
        ]
    ]
];
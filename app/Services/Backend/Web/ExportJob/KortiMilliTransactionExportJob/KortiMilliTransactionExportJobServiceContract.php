<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 11.11.2021
 * Time: 11:21
 */

namespace App\Services\Backend\Web\ExportJob\KortiMilliTransactionExportJob;


interface KortiMilliTransactionExportJobServiceContract
{
    public function create($data);
}
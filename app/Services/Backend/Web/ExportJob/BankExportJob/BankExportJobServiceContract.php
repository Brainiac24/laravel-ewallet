<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 23.07.2021
 * Time: 11:36
 */

namespace App\Services\Backend\Web\ExportJob\BankExportJob;

interface BankExportJobServiceContract
{
    public function create($data);
}
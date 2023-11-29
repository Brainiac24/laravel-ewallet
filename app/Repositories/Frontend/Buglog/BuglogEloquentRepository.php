<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Frontend\Buglog;

use App\Models\Buglog\Buglog;
use Ramsey\Uuid\Uuid;


class BuglogEloquentRepository implements BuglogRepositoryContract
{
    protected $buglogRepository;

    public function __construct(Buglog $buglogRepository)
    {
        $this->buglogRepository = $buglogRepository;
    }

    public function log($data=[])
    {
        $buglog = new Buglog();
        $buglog->tag =filter_var($data['tag']??null, FILTER_SANITIZE_STRING);
        $buglog->link =filter_var($data['link']??null, FILTER_SANITIZE_STRING);
        $buglog->response =filter_var($data['response']??null, FILTER_SANITIZE_STRING);
        $buglog->error =filter_var($data['error']??null, FILTER_SANITIZE_STRING);
        $buglog->token =filter_var($data['token']??null, FILTER_SANITIZE_STRING);
        $buglog->os =filter_var($data['os']??null, FILTER_SANITIZE_STRING);
        $buglog->version =filter_var($data['version']??null, FILTER_SANITIZE_STRING);
        $buglog->msisdn =filter_var($data['msisdn']??null, FILTER_SANITIZE_STRING);
        $buglog->save();
        return $buglog;
    }
}
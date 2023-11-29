<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 25.08.2021
 * Time: 21:46
 */

namespace App\Models\JobLog;


use App\Models\BaseModel;
use App\Models\User\User;
use App\Services\Common\Filter\Filterable;
use Illuminate\Support\Facades\Log;

class JobLogDwh extends BaseModel
{
    use Filterable;

    protected $table = "job_logs_dwh";

    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'params_json' => 'array',
        'queue_response_log' => 'array',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

}
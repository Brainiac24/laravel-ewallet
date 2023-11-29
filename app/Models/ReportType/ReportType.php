<?php

namespace App\Models\ReportType;

use App\Models\BaseModel;

class ReportType extends BaseModel
{
    protected $fillable = [
        'id',
        'code',
        'name',
    ];

    public static function listAll()
    {
        $static = new static();
        if(\Auth::user()->hasRole("sadmin")) {
            return  $static->orderBy('name')
                ->get()
                ->pluck('name', 'id');
        }else{
            $codes = [];
            foreach ($static->all() as $row) {
                if (\Auth::user()->can(["report-type-" . $row["code"]])) {
                    $codes[] = $row["code"];
                }
            }

            return  $static->whereIn("code", $codes)
                ->orderBy('name')
                ->get()
                ->pluck('name', 'id');
        }
    }
}

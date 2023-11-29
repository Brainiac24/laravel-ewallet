<?php

namespace App\Services\Backend\Web\Order\RemoteIdentification;

use Illuminate\Http\Request;

interface RemoteIdentificationServiceContract
{
    public function update(Request $request, $id);

    public function reject(Request $request, $id);

    public function accept($id);

    public function createClient($id);

    public function updateClient($id, $job_id);

    public function updateHistory($id, $data);

    public function updateStatus($id);

    public function register($id);

    public function search($id);

    public function checkJob($job_id);

    public function confirm($id, $job_id);
}
<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 28.10.2020
 * Time: 11:42
 */

namespace App\Reports\ReportType;

use App\Http\Requests\Backend\Web\Report\IndexRemoteIdentificationRequest;
use App\Reports\BaseReporter;
use App\Repositories\Backend\Order\OrderComment\OrderCommentRepositoryContract;
use App\Repositories\Backend\Order\OrderProcessStatus\OrderProcessStatusRepositoryContract;
use App\Repositories\Backend\Order\OrderStatus\OrderStatusRepositoryContract;
use App\Repositories\Backend\Order\RemoteIdentification\RemoteIdentificationRepositoryContract;
use App\Repositories\Backend\User\Attestation\AttestationRepositoryContract;
use App\Services\Backend\Web\ExportJob\RemoteIdentificationExportJob\RemoteIdentificationExportJobServiceContract;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;


class RemoteIdentifications extends BaseReporter
{
    protected $remoteIdentificationExportJobServiceContract;
    protected $remoteIdentificationRepositoryContract;
    protected $orderCommentRepositoryContract;

    public function __construct(RemoteIdentificationRepositoryContract $remoteIdentificationRepositoryContract,
                                RemoteIdentificationExportJobServiceContract $remoteIdentificationExportJobServiceContract,
                                OrderStatusRepositoryContract $orderStatusRepositoryContract,
                                OrderProcessStatusRepositoryContract $orderProcessStatusRepositoryContract,
                                OrderCommentRepositoryContract $orderCommentRepositoryContract,
                                AttestationRepositoryContract $attestationRepositoryContract)
    {
        $this->remoteIdentificationRepositoryContract = $remoteIdentificationRepositoryContract;
        $this->remoteIdentificationExportJobServiceContract = $remoteIdentificationExportJobServiceContract;
        $this->orderStatusRepositoryContract = $orderStatusRepositoryContract;
        $this->orderProcessStatusRepositoryContract = $orderProcessStatusRepositoryContract;
        $this->attestationRepositoryContract = $attestationRepositoryContract;
        $this->orderCommentRepositoryContract = $orderCommentRepositoryContract;
    }

    public function indexView(array $data) : View
    {
        $type_code = "remoteIdentifications";
        $remoteIdentifications = $this->remoteIdentificationRepositoryContract->paginate($data);
        $remoteIdentifications->appends($data);
        $filterOrderStatus = $this->orderStatusRepositoryContract->listsAll()->prepend('', '');
        $filterOrderProcessStatus = $this->orderProcessStatusRepositoryContract->listsAll()->prepend('', '');
        $filterUserAttestations = $this->attestationRepositoryContract->listsAll()->prepend('', '');
        $orderCommentCalls = $this->orderCommentRepositoryContract->commentCallRemoteIdentificationList();

        return view('backend.reports.index', compact('data', 'remoteIdentifications',
            'filterOrderStatus', 'filterOrderProcessStatus', 'filterUserAttestations','type_code', 'orderCommentCalls'));
    }

    public function exportToCsv(array $data) : void
    {
        $this->remoteIdentificationExportJobServiceContract->create($data);
    }

    public function searchFiledsView() : View
    {
        $data = [];
        $filterOrderStatus = $this->orderStatusRepositoryContract->listsAll()->prepend('', '');
        $filterOrderProcessStatus = $this->orderProcessStatusRepositoryContract->listsAll()->prepend('', '');
        $filterUserAttestations = $this->attestationRepositoryContract->listsAll()->prepend('', '');

        return view('backend.reports.partials.fields_search_boxes.remoteIdentifications', compact('data',
            'filterOrderStatus', 'filterOrderProcessStatus', 'filterUserAttestations'));
    }

    public function getRequest() : FormRequest
    {
       return \App::make(IndexRemoteIdentificationRequest::class);
    }
}
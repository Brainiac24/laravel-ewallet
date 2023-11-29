<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 28.10.2020
 * Time: 11:42
 */

namespace App\Reports\ReportType;

use App\Http\Requests\Backend\Web\Report\IndexClientRequest;
use App\Reports\BaseReporter;
use App\Repositories\Backend\User\Attestation\AttestationRepositoryContract;
use App\Repositories\Backend\User\Client\ClientRepositoryContract;
use App\Services\Backend\Web\ExportJob\ClientExportJob\ClientExportJobServiceContract;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;

class Clients extends BaseReporter
{
    protected $clientRepository;
    protected $clientExportJobService;
    protected $attestationRepository;

    public function __construct(
                                ClientRepositoryContract $clientRepositoryContract,
                                ClientExportJobServiceContract $clientExportJobServiceContract,
                                AttestationRepositoryContract $attestationRepositoryContract
    )
    {
        $this->clientRepository = $clientRepositoryContract;
        $this->clientExportJobService = $clientExportJobServiceContract;
        $this->attestationRepository = $attestationRepositoryContract;
    }

    public function indexView(array $data) : View
    {
        $type_code = "clients";
        $clients = $this->clientRepository->paginate($data);
        $attestations = $this->attestationRepository->listsAll()->prepend('', '');
        $clients->appends($data);
        return view('backend.reports.index', compact('clients', 'data', 'attestations','type_code'));
    }

    public function exportToCsv(array $data) : void
    {
        $this->clientExportJobService->create($data);
    }

    public function searchFiledsView() : View
    {
        $data = [];
        $attestations = $this->attestationRepository->listsAll()->prepend('', '');
        return view('backend.reports.partials.fields_search_boxes.clients', compact( 'data', 'attestations'));
    }

    public function getRequest() : FormRequest
    {
        return \App::make(IndexClientRequest::class);
    }
}
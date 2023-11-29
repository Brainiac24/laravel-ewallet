<?php

namespace App\Http\Controllers\Frontend\Api\User\Identification;

use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\Api\User\Attestation\AttestationResource;
use App\Repositories\Frontend\User\Attestation\AttestationRepositoryContract;
use App\Services\Common\Helpers\HttpStatusCode;
use Illuminate\Http\Request;

class IdentificationController extends Controller
{
    protected $attestationRepository;

    public function __construct(AttestationRepositoryContract $attestationRepository)
    {
        $this->attestationRepository = $attestationRepository;
    }


    public function getAttestationWithUsage()
    {
        $code = HttpStatusCode::OK;
        $attesstation = $this->attestationRepository->all();
        if ($attesstation == null) {
            throw new LogicException(trans('attesstations.errors.list_not_found'));
        }
        $data = AttestationResource::collection($attesstation);

        return \response()->apiSuccess(compact('code', 'data', 'meta'));
    }

    public function FunctionName(Type $var = null)
    {
        
    }

}

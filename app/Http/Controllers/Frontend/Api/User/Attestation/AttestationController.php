<?php

namespace App\Http\Controllers\Frontend\Api\User\Attestation;

use App\Exceptions\Frontend\Api\LogicException;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Api\User\Attestation\UpdateUserAttestationRequest;
use App\Http\Resources\Frontend\Api\User\Attestation\AttestationResource;
use App\Http\Resources\Frontend\Api\User\UserMainResource;
use App\Models\Setting\Setting;
use App\Repositories\Frontend\Setting\SettingRepositoryContract;
use App\Repositories\Frontend\User\Attestation\AttestationRepositoryContract;
use App\Repositories\Frontend\User\UserRepositoryContract;
use App\Services\Common\Helpers\Attestation;
use App\Services\Common\Helpers\HttpStatusCode;
use App\Services\Common\Helpers\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttestationController extends Controller
{
    protected $attestationRepository;
    protected $userRepository;
    protected $settingRepository;

    public function __construct(AttestationRepositoryContract $attestationRepository, UserRepositoryContract $userRepository, SettingRepositoryContract $settingRepository)
    {
        $this->attestationRepository = $attestationRepository;
        $this->userRepository = $userRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return mixed
     * @throws LogicException
     */
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

    public function setAttestation(UpdateUserAttestationRequest $request)
    {
        $code = HttpStatusCode::OK;
        $user = Auth::user();
        $validatedRequest = $request->validated();
        $attestaion_id = null;
        $data = [];
        if ($validatedRequest['confirm'] == true) {
            $attestaion_id = Attestation::IDENTIFIED;
        }
        if ($user->verification_params_json['is_verified'] == 2 && $validatedRequest['id'] == $user->verification_params_json['id']) {
            $this->userRepository->setAttestation($user->id, $validatedRequest['confirm'], $attestaion_id);
        } else {
            throw new ValidationException(trans('ERRORCODE_TO_TRANS'));
        }
        return \response()->apiSuccess(compact('code', 'data'));
    }

}

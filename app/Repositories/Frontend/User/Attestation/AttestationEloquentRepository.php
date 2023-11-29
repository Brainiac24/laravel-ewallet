<?php

namespace App\Repositories\Frontend\User\Attestation;

use App\Repositories\Frontend\User\Attestation\AttestationRepositoryContract;
use App\Models\User\Attestation\Attestation;

class AttestationEloquentRepository implements AttestationRepositoryContract
{

    protected $attestation;

    public function __construct(Attestation $attestation)
    {
        $this->attestation = $attestation;
    }

    public function all($columns = ['*'])
    {
        return $this->attestation->get($columns);
    }

    public function getDefaultAttestation($columns = ['*'])
    {
        return $this->attestation->find(config('app_settings.default_attestation_id'));
    }



}
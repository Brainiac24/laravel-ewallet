<?php

namespace App\Repositories\Frontend\User\Attestation;

interface AttestationRepositoryContract
{
    public function all($columns = ['*']);

    public function getDefaultAttestation($columns = ['*']);
}
<?php

namespace App\Services\Frontend\Api\Transaction\Traits;

use App\Exceptions\Frontend\Api\LogicException;

trait ErrorHandlerTrait
{

    public function errorHandlerServiceByIdNotFound()
    {
        if ($service == null) {
            throw new LogicException(trans('service.errors.code_not_found'));
        }
    }
    public function errorHandlerFromAccountFindByNumberNotFound()
    {
        if ($from_account == null) {
            throw new LogicException(trans('accounts.errors.code_not_found'));
        }
    }

    public function errorHandlerNotIdentifiedAccessServiceDenied($entity)
    {
        if ($user->attestation->id == Attestation::NOT_IDENTIFIED) {
            if ($service->is_enabled == 0) {
                throw new LogicException(trans('attestations.errors.not_allowed'));
            }
        }
    }

}

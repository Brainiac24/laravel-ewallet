<?php

namespace App\Services\Common\Helpers;

class Identification
{
    const OK = 0;
    const HASH_MISMATCH_EXCEPTION = -1;
    const USER_NOT_FOUND_EXCEPTION = -2;
    const ALREADY_IDENTIFIED_EXCEPTION = -3;
    const OTHER_EXCEPTION = -4;
    const WAITING_ACTIVATION = -5;
    const VALIDATION_EXCEPTION = -6;
}
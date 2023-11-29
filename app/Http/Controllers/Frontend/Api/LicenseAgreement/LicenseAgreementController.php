<?php

namespace App\Http\Controllers\Frontend\Api\LicenseAgreement;

use App\Exceptions\Frontend\Api\LogicException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LicenseAgreementController extends Controller
{

    protected $licenceAgreement;

    function __construct()
    {
        $this->licenceAgreement = "";
    }

    public function index()
    {
        try {
            $this->licenceAgreement = Storage::disk('LicenceAgreement')->get('LicenceAgreement.txt');
        } catch (\App\Exceptions\Frontend\Api\BaseException $e) {
            throw new LogicException(trans('currency_rate.errors.not_found'));
        }
        $response = \Response::make($this->licenceAgreement, 200);
        $response->header('Content-Type', 'text/html');
        return $response;
    }
}

<?php

namespace App\Http\Controllers\Backend\Web\LicenseAgreement;


use App\Http\Controllers\Controller;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LicenseAgreementController extends Controller
{
    protected $licenseAgreement;

    public function __construct()
    {
        $this->licenseAgreement = "";

        $this->middleware('license.can-show', ['only' => ['edit']]);
        $this->middleware('license.can-edit', ['only' => ['store']]);
    }

    public function edit()
    {
        $this->licenseAgreement = Storage::disk('LicenceAgreement')->get('LicenceAgreement.txt');
        $license= $this->licenseAgreement;
        Breadcrumbs::setCurrentRoute('admin.license.edit',trans('licenseAgreement.backend.title'));
        return view('backend.license.edit', compact('license'));
    }

    public function store(Request $request)
    {
        try {
            $result =  Storage::disk('LicenceAgreement')->put('LicenceAgreement.txt',$request->license_text);
        } catch (\App\Exceptions\Frontend\Api\BaseException $e) {
            throw new LogicException(trans('currency_rate.errors.not_found'));
        }
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.license.edit');
    }
}
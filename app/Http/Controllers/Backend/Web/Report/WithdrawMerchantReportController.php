<?php

namespace App\Http\Controllers\Backend\Web\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\BufferedOutput;

class WithdrawMerchantReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('registry-withdraw-merchant.can-manage', ['only' => ['index', 'runWithdrawMerchantCommand']]);
    }

    public function index()
    {

        $files = \Storage::disk('merchant_reports')->files();

        $newFiles = [];
        foreach ($files as $file) {
            if (!strpos($file, '.xlsx')) {
                unset($file);
                continue;
            }

            $link = null;
            $last_modified = null;
            $public_path = public_path() . DIRECTORY_SEPARATOR . 'merchant_reports' . DIRECTORY_SEPARATOR . $file;
            $storage_path = storage_path() . DIRECTORY_SEPARATOR . 'merchant_reports' . DIRECTORY_SEPARATOR . $file;
            $timestamp = filemtime($storage_path);

            if (\File::exists($public_path)) {
                $last_modified = date("d-m-Y H:i:s", filemtime($public_path));

                $link = asset('merchant_reports/' . $file);
            }

            $newFiles[] = [
                'file' => $file,
                'link' => $link,
                'last_modified' => $last_modified,
                'timestamp' => $timestamp,
            ];
        }

        usort($newFiles, function ($a, $b) {
            return $b['timestamp'] - $a['timestamp'];
        });

        return view('backend.reports.withdraw_merchant_report.index')->with('files', $newFiles);

    }

    public function runWithdrawMerchantCommand()
    {
        $res = new BufferedOutput;
        Artisan::call("command:withdraw_money_to_merchant_account", [], $res);
        //session()->flash('flash_message', str_replace('\n',"<br>",$res->fetch()));
        return redirect()->route('admin.withdraw_merchant.index');
    }
}

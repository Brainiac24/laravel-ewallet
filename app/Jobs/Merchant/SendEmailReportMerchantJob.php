<?php

namespace App\Jobs\Merchant;

use App\Exports\SendEmailReportMerchant\SendEmailReportMerchantExportCsv;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantRepositoryContract;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\PHPMailer;

class SendEmailReportMerchantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $jobHistoryId;
    protected $filename;
    protected $jobHistoryRepository;
    protected $email;
    protected $merchantRepository;
    protected $merchant_id;
    public $tries = 5;
    /**
     * @var PHPMailer $mailer
     */
    public $mailer;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $filename, $jobHistoryId, $email, $merchant_id)
    {
        $this->data = $data;
        $this->filename = $filename;
        $this->jobHistoryId = $jobHistoryId;
        $this->email = $email;
        $this->merchant_id = $merchant_id;
        $this->jobHistoryRepository = \App::make(JobHistoryRepositoryContract::class);
        $this->merchantRepository = \App::make(MerchantRepositoryContract::class);
        $this->mailer = $this->initPHPMailer();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::info('handling sendmail Job');
            $exporter = new SendEmailReportMerchantExportCsv($this->data);
            ini_set('memory_limit', '4096M');
            $this->jobHistoryRepository->update([
                "status" => 1,
                "payload" => $this->job->getRawBody(),
                "processed_at" => Carbon::now()->format("Y-m-d H:i:s")
            ],
                $this->jobHistoryId);
            $response = $exporter->store($this->filename);

            if ($response['status'] == 'success') {
                Log::info('created report file '.$this->filename);
                if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                    Log::info('email to send '.$this->email);
                    $this->sendEmail($response['path'], 'Merchant_tranzaction_' . Carbon::now()->toDateString() . '.csv');
                    $this->merchantRepository->updateLastSend(Carbon::now()->format('Y-m-d'), $this->merchant_id);
                }
            }
            $this->jobHistoryRepository->update(["status" => 2, "finished_at" => Carbon::now()->format("Y-m-d H:i:s")], $this->jobHistoryId);
        } catch (\Exception $ex){
            \Log::error(json_encode($ex->getMessage()));
            \Log::error(json_encode($ex->getTrace()));
        }
    }

    public function failed(\Exception $exception)
    {
        $this->jobHistoryRepository
            ->update(["status" => -1, "finished_at" => Carbon::now()->format("Y-m-d H:i:s"),"error_message" => $exception->getMessage()],$this->jobHistoryId);
    }

    function sendEmail($path, $fileName){

        $res = false;
        try{
            $this->mailer->setFrom(config('mail.from.address'), 'Банк Эсхата');
            $this->mailer->Subject = 'Отчеты по QR';
            $this->mailer->Body    = "<p>К письму прикреплен Файл с отчетом: '$fileName'</p>";
            $this->mailer->addAttachment($path);
            $this->mailer->addAddress($this->email);
            // Add a recipient
           if($this->mailer->send()){
               Log::info('mail sended');
           }
            $res = true;
        } catch (\Exception $e) {
            Log::info('cant send email');
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }

        return $res;
    }

    private function initPHPMailer()
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'mail.eskhata.tj';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for PHPMailer::ENCRYPTION_SMTPS above
        $mail->Username = config('mail.username');
        $mail->Password = config('mail.password');

        // Content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        return $mail;
    }

}

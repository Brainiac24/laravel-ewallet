<?php
namespace App\Reports;


use Illuminate\Foundation\Http\FormRequest;

abstract class BaseReporter implements ReporterContract
{
    public function applyIndex()
    {
        $data = $this->getRequest()->validated();

        if (isset($data['export'])) {
            try {
                $this->exportToCsv($data);
                session()->flash('flash_message', "Задача для формирование отчета создано. Вы сможете найти свою выгрузку в разделе \"Задачи\"");

                return redirect()->route('admin.reports.index', ["report_type_id" => $data["report_type_id"]]);
            }catch (\Exception $e)
            {
                session()->flash('flash_message_error', $e->getMessage());
                return redirect()->route('admin.reports.index',["report_type_id" => $data["report_type_id"]]);
            }
        }

        return $this->indexView($data);
    }
}
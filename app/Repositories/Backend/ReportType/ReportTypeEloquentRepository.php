<?php

namespace App\Repositories\Backend\ReportType;

use App\Models\ReportType\ReportType;

class ReportTypeEloquentRepository implements ReportTypeRepositoryContract
{

    protected $reportType;

    public function __construct(ReportType $reportType)
    {
        $this->reportType = $reportType;
    }

    public function create(array $data)
    {
        return $this->reportType->create($data);
    }

    public function update(array $data, $id)
    {
        $reportType = $this->reportType->findOrFail($id);
        $reportType->setOldAttributes($reportType->getAttributes());
        $reportType->update($data);
        return $reportType;
    }

    public function findById($id)
    {
        return $this->reportType->where('id', $id)->first();
    }

    public function findByCode($code)
    {
        return $this->reportType->where('code', $code)->first();
    }

    public function paginate($perPage = 30)
    {
        return $this->reportType->orderBy('name')->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->reportType->orderBy('name')->get()->pluck('name', 'id');
    }
}
<?php


namespace App\Repositories\Backend\ReportAnalysis;


use App\Models\ReportAnalysis\ReporAnalysis;

class ReportAnalysisEloquentRepository implements ReportAnalysisRepositoryContract
{
    protected $reportAnalysis;

    public function __construct(ReporAnalysis $reportAnalysis)
    {
        $this->reportAnalysis = $reportAnalysis;
    }

    public function all($search)
    {
        return $this->reportAnalysis->where('name', 'like','%' . $search . '%')->orderBy('name')->get();
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->reportAnalysis->select($columns)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getById($id)
    {
        return $this->reportAnalysis->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $reportAnalysis = $this->getById($id);
        $reportAnalysis->setOldAttributes($reportAnalysis->getAttributes());
        $reportAnalysis->update($data);
        return $reportAnalysis;
    }

    public function destroy($id)
    {
        $reportAnalysis = $this->getById($id);
        $reportAnalysis->is_active = 0;
        $reportAnalysis->save();
        return $reportAnalysis;
    }

    public function create(array $data)
    {
        return $this->reportAnalysis->create($data);
    }

    public function listsAll()
    {
        return $this->reportAnalysis->get()->pluck('name', 'id');
    }
}
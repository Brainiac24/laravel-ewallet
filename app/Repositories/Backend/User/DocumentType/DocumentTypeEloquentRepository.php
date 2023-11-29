<?php

namespace App\Repositories\Backend\User\DocumentType;

use App\Repositories\Backend\User\DocumentType\DocumentTypeRepositoryContract;
use App\Models\DocumentType\DocumentType;

class DocumentTypeEloquentRepository implements DocumentTypeRepositoryContract
{

    protected $documentType;

    public function __construct(DocumentType $documentType)
    {
        $this->documentType = $documentType;
    }

    public function all($columns = ['*'])
    {
        return $this->documentType->get($columns);
    }

    public function getIdByCodeMap($code)
    {
        $item = $this->documentType->where('code_map', $code)->first();
        return $item != null ? $item->id : null;
    }

    public function getIdByDesc($text)
    {
        $item = $this->documentType->where('desc', $text)->first();
        return $item != null ? $item->id : null;
    }

    public function getById($id)
    {
        return $this->documentType->with('user')->where('id', $id)->first();
    }

    public function listsAll()
    {
        return $this->documentType->orderBy('name')->get()->pluck('name', 'id');
    }

    public function listsByCode($code)
    {
        return $this->documentType->where(["code" => $code])->orderBy('name')->get()->pluck('desc', 'id');
    }


    public function update(array $data, $id)
    {
        $documentType = $this->documentType->findOrFail($id);
        $documentType->setOldAttributes($documentType->getAttributes());
        $documentType->update($data);
        return $documentType;
    }

    public function create(array $data)
    {
        return $this->documentType->create($data);
    }

    public function getAll($search)
    {
        return $this->documentType->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function destroy($id)
    {
        $documentType = $this->documentType->findOrFail($id);
        $documentType->is_active = 0;
        $documentType->save();
        return $documentType;
    }

    public function findById($id)
    {
        return $this->documentType->findOrFail($id);
    }
}
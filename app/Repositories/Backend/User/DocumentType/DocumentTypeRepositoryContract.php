<?php

namespace App\Repositories\Backend\User\DocumentType;

interface DocumentTypeRepositoryContract
{
    public function all($columns = ['*']);

    public function getAll($search);

    public function findById($id);

    public function update(array $data, $id);

    public function create(array $data);

    public function destroy($id);
}
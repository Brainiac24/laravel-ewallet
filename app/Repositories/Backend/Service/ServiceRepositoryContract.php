<?php

namespace App\Repositories\Backend\Service;

interface ServiceRepositoryContract
{
    public function all($data = [],$columns = ['*']);
    public function allPluck($columns = ['*']);
    public function getByCode($code, $columns = ['*']);
    public function getIdByCode($code);
    public function allActive($columns = ['*']);
    public function findById($id, $columns = ['*']);
    public function create(array $data);
    public function update(array $data, $id);
    public function destroy($id);
    public function getById($id, $columns = ['*']);
    public function getProcessingCodeByCode($processingCode, $columns = ['*']);
    public function paginate($perPage = 10, $columns = ['*']);

    public function deleteImageIconUrl($id);
    public function deleteImageInIconUrl($id);
    public function deleteImageOutIconUrl($id);
    public function onOff($is_active, $id);
}
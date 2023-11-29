<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.07.2017
 * Time: 16:58
 */

namespace App\Repositories\Backend\User\Attestation;

interface AttestationRepositoryContract
{
	/**
	 * @param array $columns
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all($columns = ['*']);

	/**
	 * method pluck key -> value
	 *
	 * @return mixed
	 */
	public function listsAll();

	/**
	 * @param int $perPage
	 * @param array $columns
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function paginate($perPage = 30, $columns = ['*']);

	/**
	 * @param array $data
	 */
	public function create(array $data);

	/**
	 * @param $id
	 * @param array $columns
	 * @return mixed
	 */
	public function findById($id, $columns = ['*']);

	/**
	 * @param array $data
	 * @param $id
	 */
	public function update(array $data, $id);

	/**
	 *
	 */
	public function destroy($id);
}
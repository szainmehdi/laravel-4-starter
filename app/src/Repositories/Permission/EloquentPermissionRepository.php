<?php namespace App\Repositories\Permission;

use App\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

class EloquentPermissionRepository extends EloquentRepository implements PermissionRepository
{

    /**
     * @param array $input
     *
     * @return Model
     */
    public function create(array $input)
    {

    }

    /**
     * @param int $id
     * @param array $input
     *
     * @return Model
     */
    public function update($id, array $input)
    {

    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
<?php namespace App\Repositories\Role;

use App\Models\Auth\Role;
use App\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

class EloquentRoleRepository extends EloquentRepository implements RoleRepository
{
    function __construct(Role $model)
    {
        parent::__construct($model);
    }


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
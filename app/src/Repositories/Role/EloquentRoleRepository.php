<?php namespace App\Repositories\Role;

use App\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

class EloquentRoleRepository extends EloquentRepository implements RoleRepository
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
}
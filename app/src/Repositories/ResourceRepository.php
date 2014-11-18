<?php namespace App\Repositories;

use App\Validation\ValidationException;
use Illuminate\Database\Eloquent\Model;

interface ResourceRepository {

    /**
     * @param array $input
     *
     * @return Model
     */
    public function create(array $input);

    /**
     * @param int $id
     * @param array $input
     *
     * @return Model
     */
    public function update($id, array $input);

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete($id);

} 
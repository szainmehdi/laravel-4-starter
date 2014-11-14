<?php namespace App\Repositories;

use App\Validation\ValidationException;
use Illuminate\Database\Eloquent\Model;

interface ResourceRepository {

    /**
     * @param array $input
     *
     * @throws ValidationException
     * @return Model
     */
    public function create(array $input);

    /**
     * @param int $id
     * @param array $input
     *
     * @throws ValidationException
     * @return Model
     */
    public function update($id, array $input);

} 
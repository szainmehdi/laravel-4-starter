<?php namespace App\Repositories;

use Illuminate\Support\Collection;

interface BaseRepository {

    /**
     * @param array $columns
     * @param array $with
     *
     * @return Collection
     */
    public function all($columns = ['*'], array $with = []);

    /**
     * @param $id int
     * @param array $columns
     * @param array $with
     *
     * @return object
     */
    public function find($id, $columns = ['*'], array $with = []);


    /**
     * @param $key
     * @param $value
     * @param int $paginate Count of paginatated entries per page. 0 => No pagination
     * @param array $columns
     * @param array $with
     *
     * @return object
     */
    public function like($key, $value, $paginate = 0, $columns = ['*'], array $with = []);

    /**
     * Find a single entity by key value
     *
     * @param string $key
     * @param string $value
     * @param string $operator
     * @param array $with
     *
     * @return object
     */
    public function getFirstWhere($key, $value, $operator = '=', array $with = []);

    /**
     * Find many entities by key value
     *
     * @param string $key
     * @param string $value
     * @param string $operator
     * @param array $with
     *
     * @return Collection
     */
    public function getWhere($key, $value, $operator = '=', array $with = []);

    /**
     * @param $count int
     * @param array $columns
     * @param array $with
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function paginate($count, array $columns = ['*'], array $with = []);
    /**
     * @param $column string
     * @param $value mixed
     * @param string $operator
     * @param string $boolean
     */

}
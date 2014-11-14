<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository implements BaseRepository {

    /**
     * @var Model
     */
    protected $model;

    /**
     * Sort all results by this column
     * ex. 'id'
     * ex. ['id' => 'asc']
     * ex. ['id' => 'asc','name' => 'desc']
     *
     * @var array
     */
    protected $orderBy = ['id' => 'asc'];

    private $whereConstraints = [];

    /**
     * Eager load these relations for every query.
     *
     * @var array
     */
    protected $eagerLoadDefaults = [];

    /**
     * @param Model $model
     */
    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * @param array $columns
     * @param array $with
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function all($columns = ['*'], array $with = []) {
        return $this->make($with)->get($columns);
    }


    /**
     * @param $count int
     * @param array $columns
     * @param array $with
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function paginate($count, array $columns = ['*'], array $with = []) {
        return $this->make($with)->paginate($count, $columns);
    }

    /**
     * @param $id int
     * @param array $columns
     * @param array $with
     *
     * @return \Illuminate\Support\Collection|static
     */
    public function find($id, $columns = ['*'], array $with = []) {
        return $this->make($with)->find($id, $columns);
    }

    /**
     * @param $key
     * @param $value
     * @param int $paginate Count of paginatated entries per page. 0 => No pagination
     * @param array $columns
     * @param array $with
     *
     * @return object
     */
    public function like($key, $value, $paginate = 0, $columns = ['*'], array $with = []) {
        $query = $this->make($with);

        if (is_array($key)) {
            $query->where(function ($query) use ($key, $value) {
                $first = true;
                foreach ($key as $k) {
                    if ($first) {
                        $query->where($k, 'LIKE', '%' . $value . '%');
                        $first = false;
                        continue;
                    }
                    $query->orWhere($k, 'LIKE', '%' . $value . '%');
                }
            });
        } else {
            $query->where($key, 'LIKE', '%' . $value . '%');
        }

        return ($paginate > 0) ? $query->paginate($paginate, $columns) : $query->get($columns);
    }


    /**
     * Find a single entity by key value
     *
     * @param string $key
     * @param string $value
     * @param string $operator
     * @param array $with
     *
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getFirstWhere($key, $value, $operator = '=', array $with = []) {
        return $this->make($with)->where($key, $operator, $value)->first();
    }

    /**
     * Find many entities by key value
     *
     * @param string $key
     * @param string $value
     * @param string $operator
     * @param array $with
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWhere($key, $value, $operator = '=', array $with = []) {
        return $this->make($with)->where($key, $operator, $value)->get();
    }

    /**
     * @return array
     */
    public final function getOrderBy() {
        if (!is_array($this->orderBy)) {
            $this->orderBy = [$this->orderBy => 'asc'];
        }
        return $this->orderBy;
    }

    /**
     * @param array|string $orderBy
     */
    public final function setOrderBy($orderBy) {
        $this->orderBy = $orderBy;
    }

    /**
     * @param $with array
     *
     * @return array
     */
    private final function getEagerLoadRelations(array $with) {
        return array_merge($with, $this->eagerLoadDefaults);
    }


    /**
     * Make a new instance of the entity to query on
     *
     * @param array $with
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public final function make(array $with = []) {
        $relations = $this->getEagerLoadRelations($with);

        $query = $this->model->query();
        $query = $this->sortQuery($query);
        $query = $this->buildWhereConstraints($query);

        return $query->with($relations);
    }


    private final function sortQuery(Builder $query) {

        $sorts = $this->getOrderBy();

        foreach ($sorts as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query;
    }

    /**
     * @param $column string
     * @param $value mixed
     * @param string $operator
     * @param string $boolean
     */
    public final function setGlobalWhereConstraint($column, $value, $operator = '=', $boolean = 'and') {
        $this->whereConstraints[] = [
            'column' => $column,
            'value' => $value,
            'operator' => $operator,
            'boolean' => $boolean
        ];
    }

    public function clearGlobalWhereConstraint() {
        $this->whereConstraints = [];
    }

    private function buildWhereConstraints(Builder $query) {
        foreach ($this->whereConstraints as $constraint) {
            $query = $query->where(
                $constraint['column'],
                $constraint['operator'],
                $constraint['value'],
                $constraint['boolean']
            );
        }

        return $query;
    }


} 
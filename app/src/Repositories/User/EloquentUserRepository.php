<?php namespace App\Repositories\User;

use App\Models\Auth\User;
use App\Repositories\EloquentRepository;
use App\Repositories\Role\RoleRepository;
use Role;

/**
 * Class EloquentUserRepository
 *
 * @property User $model
 * @package App\Repositories\User
 */
class EloquentUserRepository extends EloquentRepository implements UserRepository
{

    /**
     * Sort all results by this column
     *
     * @var string
     */
    protected $orderBy = 'first_name';

    /**
     * Eager load these relations for every query.
     *
     * @var array
     */
    protected $eagerLoadDefaults = ['roles'];
    /**
     * @var RoleRepository
     */
    private $roleRepo;

    /**
     * @param RoleRepository $roleRepo
     * @param User $model
     */
    public function __construct(RoleRepository $roleRepo, User $model)
    {
        parent::__construct($model);
        $this->roleRepo = $roleRepo;
    }

    /**
     * @param array $input
     *
     * @return User|null
     */
    public function create(array $input)
    {
        // Create the new dealer and save it.
        $this->model = new User();

        // Fill in the data we can fill in.
        $this->model->fill($input);

        // Since mass assignment for these fields is not allowed,
        // we'll set these manually.
        $this->model->email = $input['email'];
        $this->model->password = $input['password'];
        $this->model->password_confirmation = $input['password_confirmation'];

        $this->model->save();

        if (!empty($input['role'])) {
            /** @var Role $role */
            $roles = [$input['role']];
            $this->model->roles()->sync($roles);
        }

        return $this->model;
    }

    /**
     * Attempts to login with the given credentials.
     *
     * @param $email
     * @param $password
     *
     * @return  boolean
     */
    public function login($email, $password)
    {
        $this->model = $this->getFirstWhere('email', $email);

        $isPasswordCorrect = \Hash::check($password, $this->model->password);

        if (!$isPasswordCorrect) {
            return false;
        }
        return true;
    }

    /**
     * @param int $id
     * @param array $input
     *
     * @return User
     */
    public function update($id, array $input)
    {
        // Find the dealer we are updating
        $this->model = $this->find($id);

        // Fill in the data we can fill in.
        $this->model->fill($input);

        // Since mass assignment for these fields is not allowed,
        // we'll set these manually.
        $this->model->email = $input['email'];

        if (!empty($input['role'])) {
            $roles = [$input['role']];
            $this->model->roles()->sync($roles);
        }

        if (!empty($input['password'])) {
            $this->model->password = $input['password'];
            $this->model->password_confirmation = $input['password_confirmation'];
        }

        return ($this->model->save()) ? $this->model : null;
    }

    /**
     * Delete the instance of the model.
     *
     * @param $id
     *
     * @return bool
     */
    public function delete($id)
    {
        $this->model = $this->find($id);
        return $this->model->delete();
    }
}
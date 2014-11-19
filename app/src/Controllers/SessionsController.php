<?php namespace App\Controllers;

use App\Repositories\User\UserRepository;

class SessionsController extends BaseController
{
    /**
     * @var UserRepository
     */
    private $repo;

    /**
     * @param UserRepository $repo
     */
    function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Show the login form.
     */
    public function create()
    {
        // TODO - Login.
    }

    /**
     * Sign in a user and start a new session.
     */
    public function store()
    {
        // TODO - Sign in a user.
    }

    /**
     * Log out the user.
     */
    public function destroy()
    {
        // TODO - Log out a user.
    }

} 
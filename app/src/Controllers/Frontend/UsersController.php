<?php namespace App\Controllers\Frontend;

use App;
use App\Controllers\BaseController;
use App\Repositories\User\UserRepository;

class UsersController extends BaseController
{

    /**
     * @var UserRepository
     */
    private $repo;

    /**
     * @var App
     */
    private $app;

    /**
     * @param App $app
     * @param UserRepository $repo
     */
    function __construct(App $app, UserRepository $repo)
    {
        $this->repo = $repo;
        $this->app = $app;
    }

    public function create()
    {
        return view('frontend.signup');
    }

    public function store()
    {
        $input = $this->app['input']->all();

        $this->repo->create($input);

    }

} 
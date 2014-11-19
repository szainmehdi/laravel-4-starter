<?php namespace App\Models\Auth;

use Zizaco\Entrust\HasRole;

class User extends \Eloquent
{

    use HasRole;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

}

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

    public static $rules = [
        'first_name' => 'required|between:2,16',
        'last_name' => 'required|between:2,16',
        'email' => 'required|email',
        'password' => 'required|alpha_num|between:4,8|confirmed',
    ];

    public static $passwordAttributes = ['password'];

    public $autoHashPasswordAttributes = true;
}

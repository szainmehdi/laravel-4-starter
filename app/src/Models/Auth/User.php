<?php namespace App\Models\Auth;

use App\Validation\HasValidation;
use App\Validation\Validatable;
use Zizaco\Entrust\HasRole;

/**
 * Class User
 *
 * @package App\Models\Auth
 */
class User extends \Eloquent implements Validatable
{

    use HasRole;
    use HasValidation;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return array
     */
    public function getValidationRules()
    {
        return [
            'first_name' => 'required|between:2,16',
            'last_name' => 'required|between:2,16',
            'email' => 'required|email',
            'password' => 'required|alpha_num|between:4,8|confirmed',
        ];
    }

}

<?php namespace App\Validation\Forms;

/**
 * Class ExampleForm
 * Example form validation class.
 * Inject this class into your controller and validate like so:
 * <code>$this->registrationForm->validate(Input::all());</code>
 *
 * @package App\Validation\Forms
 */
class ExampleForm extends FormValidator
{

    /**
     * Validation rules for sample form.
     *
     * @var array
     */
    protected $rules = [
        'username' => 'required',
        'email' => 'required|unique:users',
        'age' => 'required|integer',
        'gender' => 'in:male,female',
        'password' => 'required|confirmed'
    ];

} 
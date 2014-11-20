<?php namespace App\Validation;


use Illuminate\Support\MessageBag;

trait HasValidation
{
    protected $throwsException = false;

    /** @var $errors MessageBag */
    protected $errors;

    public static function boot()
    {
        parent::boot();
        static::saving(function (Validatable $model) {
            return $model->isValid();
        });
    }

    /**
     * @return MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function isValid()
    {
        $validation = \Validator::make($this->getAttributes(), $this->getValidationRules());

        if ($validation->fails()) {
            $this->errors = $validation->messages();
            if ($this->throwsException) {
                throw new ValidationException($this->errors);
            }
            return false;
        }

        return true;
    }

    public function getValidationRules()
    {
        return [];
    }

} 
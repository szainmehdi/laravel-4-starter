<?php namespace App\Validation;

use Illuminate\Support\MessageBag;

interface Validatable
{

    /**
     * @return bool
     */
    public function isValid();

    /**
     * @return array
     */
    public function getValidationRules();

    /**
     * @return MessageBag
     */
    public function getErrors();

    /**
     * @return array
     */
    public function getAttributes();
} 
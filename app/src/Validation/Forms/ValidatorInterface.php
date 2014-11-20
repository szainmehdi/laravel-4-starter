<?php namespace App\Validation\Forms;


use Illuminate\Support\MessageBag;

interface ValidatorInterface
{
    /**
     * Determine if the validation failed
     *
     * @return bool
     */
    public function fails();

    /**
     * Get the list of validation errors
     *
     * @return MessageBag|array
     */
    public function errors();
} 
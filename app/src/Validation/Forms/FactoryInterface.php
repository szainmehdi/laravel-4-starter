<?php namespace App\Validation\Forms;

interface FactoryInterface
{

    /**
     * Initialize validator
     *
     * @param array $data
     * @param array $rules
     * @param array $messages
     *
     * @return ValidatorInterface
     */
    public function make(array $data, array $rules, array $messages = []);

} 
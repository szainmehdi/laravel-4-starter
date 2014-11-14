<?php namespace App\Presenters;

abstract class Presenter {


    /**
     * @var mixed
     */
    protected $entity;
    /**
     * @var null
     */
    private $emptyAction;

    /**
     * @param $entity
     */
    function __construct($entity, $emptyAction = null) {
        $this->entity = $entity;
        $this->emptyAction = $emptyAction;
    }

    /**
     * Allow for property-style retrieval
     *
     * @param $property
     *
     * @return mixed
     */
    public function __get($property) {
        if (method_exists($this, $property)) {
            return $this->{$property}();
        }

        if (method_exists($this, $camel = \Str::camel($property))) {
            return $this->{$camel}();
        }


        return $this->entity->{$property};
    }

} 
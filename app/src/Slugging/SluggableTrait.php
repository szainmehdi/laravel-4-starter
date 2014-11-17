<?php namespace App\Traits;

use App\Traits\SluggableTraitCustom as Custom;
use Cviebrock\EloquentSluggable\SluggableTrait as Original;

trait SluggableTrait {
    use Original, Custom {
        Custom::findBySlug insteadof Original;
    }
}
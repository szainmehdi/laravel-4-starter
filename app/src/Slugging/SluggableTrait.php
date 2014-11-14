<?php namespace AutoAdsToday\Traits;

use AutoAdsToday\Traits\SluggableTraitCustom as Custom;
use Cviebrock\EloquentSluggable\SluggableTrait as Original;

trait SluggableTrait {
    use Original, Custom {
        Custom::findBySlug insteadof Original;
    }
}
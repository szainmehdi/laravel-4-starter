<?php namespace App\Composers;

use Illuminate\View\View;

class SampleViewComposer implements ViewComposer {

    public function compose(View $view) {
        $view->with(
            'zip',
            (!empty($_COOKIE['location_zip'])
                ? $_COOKIE['location_zip']
                : 'N/A')
        );
    }

}
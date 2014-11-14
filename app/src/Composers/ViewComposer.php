<?php namespace App\Composers;

use Illuminate\View\View;

interface ViewComposer {

    /**
     * @param View $view
     *
     * @return mixed
     */
    public function compose(View $view);

}
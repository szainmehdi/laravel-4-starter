<?php namespace App\Filters;

use Auth;
use Flash;
use Redirect;

class GuestFilter {

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function filter() {
        if (Auth::check()) {
            Flash::success("You're already logged in!");
            return Redirect::route('dashboard.index');
        }
    }

}
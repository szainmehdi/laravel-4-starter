<?php namespace App\Filters;

use Auth;
use Redirect;
use Request;
use Response;
use Role;
use URL;

class AuthFilter {

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function filter() {
        if (Auth::guest()) {
            if (Request::ajax()) {
                return Response::make('Unauthorized', 401);
            } else {
                return Redirect::guest(URL::route('dashboard.login'));
            }
        } else if (Auth::user()->hasRole(Role::DISABLED)) {
            Auth::logout();
            \Flash::warning("Your account seems to be disabled. Try again or contact support.");
            return Redirect::guest(URL::route('dashboard.login'));
        }
    }

}
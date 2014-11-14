<?php namespace App\Filters;

use Auth;
use Redirect;

class DashboardFilter {

    public function filter() {
        if (Auth::user()->hasRole(\Role::DISABLED)) {
            Auth::logout();
            return Redirect::route('dashboard.login')
                ->withInput()->withFlashMessage('Your account appears to be disabled. Try again or contact support.');
        }
    }

} 
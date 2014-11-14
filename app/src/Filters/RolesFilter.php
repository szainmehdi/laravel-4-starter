<?php namespace App\Filters;

use Auth;
use Flash;

class RolesFilter {

    public function filter($route, $request, $value) {
        $roles = [];

        // TODO - Implement roles checking

        if (!Auth::user()->hasRoles($roles)) {
            Flash::error('You are not authorized to access this resource.');
            return redirect_back_or_to('home');
        }

    }

} 
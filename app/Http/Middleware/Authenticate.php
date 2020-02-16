<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Auth\AuthenticationException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public $login;

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route($this->login);
        }
    }

    protected function unauthenticated($request, array $guards)
    {
        $guard = $guards[0];

        switch ($guard) {
            case 'admin':
                $this->login = 'admin.login';
                break;
            
            default:
                $this->login = 'login';
                break;
        }

        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request)
        );
    }

}

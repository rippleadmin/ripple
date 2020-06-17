<?php

namespace WaterAdmin\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers as BaseAuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use WaterAdmin\Cache\RateLimiter;

trait AuthenticatesUsers
{
    use BaseAuthenticatesUsers;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Increment the login attempts for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function incrementLoginAttempts(Request $request)
    {
        $this->limiter()->hit(
            $this->throttleKey($request), array_map(function ($decayMinute) {
                return (int) ($decayMinute * 60);
            }, (array) $this->decayMinutes())
        );
    }

    /**
     * Get the rate limiter instance.
     *
     * @return \WaterAdmin\Cache\RateLimiter
     */
    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('water');
    }
}


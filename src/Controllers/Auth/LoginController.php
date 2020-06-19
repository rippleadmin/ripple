<?php

namespace WaterAdmin\Controllers\Auth;

use Illuminate\Http\Request;
use WaterAdmin\Auth\AuthenticatesUsers;
use WaterAdmin\Cache\RateLimiter;
use WaterAdmin\Controllers\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * The maximum number of attempts to allow.
     *
     * @var int
     */
    protected $maxAttempts = 5;

    /**
     * The number of minutes to throttle for.
     *
     * @var int|float|int[]|float[]
     */
    protected $decayMinutes = 1;

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
     * Get the where to redirect users after login.
     *
     * @return string
     */
    public function redirectTo()
    {
        return route('water.home');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('water.guest')->except('logout');
    }
}

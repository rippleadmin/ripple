<?php

namespace RippleAdmin\Cache;

use Illuminate\Cache\RateLimiter as BaseRateLimiter;

class RateLimiter extends BaseRateLimiter
{
    /**
     * Determine if the given key has been "accessed" too many times.
     *
     * @param  string  $key
     * @param  int  $maxAttempts
     * @return bool
     */
    public function tooManyAttempts($key, $maxAttempts)
    {
        if ($this->attempts($key) >= $maxAttempts) {
            if ($this->cache->has($key.':ripple_admin_timer')) {
                return true;
            }

            $this->resetAttempts($key);
        }

        return false;
    }

    /**
     * Increment the counter for a given key for a given decay time.
     *
     * @param  string  $key
     * @param  int|int[]  $decaySeconds
     * @return int
     */
    public function hit($key, $decaySeconds = 60)
    {
        if (is_array($decaySeconds)) {
            if (! $this->cache->has($key.':ripple_admin_timer')) {
                if (! $this->cache->has($key.':ripple_admin_step')) {
                    $this->cache->add($key.':ripple_admin_step', 0, 86400);
                } else {
                    $this->cache->increment($key.':ripple_admin_step');
                }
            }

            $step = $this->cache->get($key.':ripple_admin_step', 0);
            $step = $step < count($decaySeconds) ? $step : count($decaySeconds) - 1;
            $decaySeconds = $decaySeconds[$step];
        }

        $this->cache->add(
            $key.':ripple_admin_timer', $this->availableAt($decaySeconds), $decaySeconds
        );

        $added = $this->cache->add($key, 0, $decaySeconds);

        $hits = (int) $this->cache->increment($key);

        if (! $added && $hits == 1) {
            $this->cache->put($key, 1, $decaySeconds);
        }

        return $hits;
    }

    /**
     * Clear the hits and lockout timer for the given key.
     *
     * @param  string  $key
     * @return void
     */
    public function clear($key)
    {
        $this->cache->forget($key.':ripple_admin_step');

        $this->resetAttempts($key);

        $this->cache->forget($key.':ripple_admin_timer');
    }

    /**
     * Get the number of seconds until the "key" is accessible again.
     *
     * @param  string  $key
     * @return int
     */
    public function availableIn($key)
    {
        return $this->cache->get($key.':ripple_admin_timer') - $this->currentTime();
    }
}

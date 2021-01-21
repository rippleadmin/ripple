<?php

namespace RippleAdmin\Concerns;

use RippleAdmin\Droplet;

trait HasActions
{
    /**
     * Get the action instance.
     *
     * @param  string  $action
     * @param  array  $parameters
     * @return \RippleAdmin\Action
     */
    public function action(string $action, array $parameters = [])
    {
        /** @var \RippleAdmin\Action $action */
        $action = app($action, $parameters);

        if ($this instanceof Droplet) {
            $action->setDroplet($this);
        }

        return $action;
    }
}

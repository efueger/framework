<?php

namespace Framework\View;

use Framework\View\Manager\ServiceTrait as ViewManager;

trait PluginTrait
{
    /**
     *
     */
    use ViewManager;

    /**
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call($name, array $args = [])
    {
        return $this->call($name, $args);
    }
}

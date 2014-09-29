<?php

namespace Framework\View\Plugin;

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
        return call_user_func_array($this->plugin($name), $args);
    }
}

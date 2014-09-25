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
     * @param null $args
     * @return mixed
     */
    public function __call($name, $args = null)
    {
        return call_user_func_array($this->plugin($name), (array) $args);
    }
}

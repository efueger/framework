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
     * @param $name
     * @param $args
     * @return mixed
     */
    public function __call($name, $args)
    {
        return call_user_func_array($this->plugin($name), $args);
    }
}

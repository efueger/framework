<?php

namespace Framework\View\Model;

use Framework\View\Manager\ViewManager;

interface Plugin
{

    /**
     * @return ViewManager
     */
    function viewManager();

    /**
     * @param ViewManager $vm
     * @return void
     */
    function setViewManager(ViewManager $vm);

    /**
     * @param $name
     * @param array $args
     * @return mixed
     */
    function __call($name, array $args = []);
}

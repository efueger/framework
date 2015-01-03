<?php
/**
 *
 */

namespace Framework\View\Manager;

use Exception;
use Framework\View\Model\ViewModel;

interface ViewManager
{
    /**
     * @param array|callable|object|string $name
     * @param array $args
     * @param callable $callback
     * @return null|callable|object
     */
    function call($name, array $args = [], callable $callback = null);

    /**
     * @param Exception $exception
     * @return mixed
     */
    function exception(Exception $exception);

    /**
     * @param $name
     * @return mixed
     */
    function param($name);

    /**
     * @param string $name
     * @param callable $callback
     * @return null|callable|object
     */
    function plugin($name, callable $callback = null);

    /**
     * @param ViewModel $model
     * @return mixed
     */
    function render(ViewModel $model);
}

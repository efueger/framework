<?php

namespace Framework\View\Manager;

use Exception;
use Framework\View\Model\ModelInterface as ViewModel;

interface ManagerInterface
{
    /**
     * @param string $name
     * @param array $args
     * @param callable $callback
     * @return null|callable|object
     */
    function call($name, array $args = [], callable $callback = null);

    /**
     * @param Exception $exception
     * @param callable $callback
     * @return mixed
     */
    function exception(Exception $exception, callable $callback = null);

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
     * @param ViewModel $viewModel
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function render(ViewModel $viewModel, array $args = [], callable $callback = null);
}

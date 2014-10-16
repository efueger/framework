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
     * @return mixed
     */
    function exception(Exception $exception);

    /**
     * @param string $name
     * @param callable $callback
     * @return null|callable|object
     */
    function plugin($name, callable $callback = null);

    /**
     * @param ViewModel $viewModel
     * @param array $args
     * @return mixed
     */
    function render(ViewModel $viewModel, array $args = []);
}

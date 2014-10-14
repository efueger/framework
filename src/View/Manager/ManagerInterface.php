<?php

namespace Framework\View\Manager;

use Exception;
use Framework\View\Model\ModelInterface as ViewModel;

interface ManagerInterface
{
    /**
     * @param Exception $exception
     * @return mixed
     */
    function exception(Exception $exception);

    /**
     * @param string $name
     * @param array $args
     * @return null|callable|object
     */
    function plugin($name, array $args = []);

    /**
     * @param ViewModel $viewModel
     * @param array $args
     * @return mixed
     */
    function render(ViewModel $viewModel, array $args = []);
}

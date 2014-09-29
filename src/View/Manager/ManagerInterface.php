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
    public function exception(Exception $exception);

    /**
     * @param string $name
     * @param array $args
     * @return null|callable|object
     */
    public function plugin($name, array $args = []);

    /**
     * @param ViewModel $viewModel
     * @param array $options
     * @return mixed
     */
    public function render(ViewModel $viewModel, array $options = []);
}

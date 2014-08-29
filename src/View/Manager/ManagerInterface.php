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
     * @param null $args
     * @return null|callable|object
     */
    public function plugin($name, $args = null);

    /**
     * @param ViewModel $viewModel
     * @param null $options
     * @return mixed
     */
    public function render(ViewModel $viewModel, $options = null);
}

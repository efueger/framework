<?php

namespace Framework\View\Manager;

use Exception;
use Framework\View\Model\ModelInterface as ViewModel;

trait ServiceTrait
{
    /**
     * @var ManagerInterface
     */
    protected $vm;

    /**
     * @param string $name
     * @param array $args
     * @return callable|mixed|null|object
     */
    public function call($name, array $args = [])
    {
        return $this->vm->call($name, $args);
    }

    /**
     * @param Exception $exception
     * @return mixed
     */
    public function exception(Exception $exception)
    {
        return $this->vm->exception($exception);
    }

    /**
     * @param string $name
     * @param callable $callback
     * @return null|callable|object
     */
    public function plugin($name, callable $callback = null)
    {
        return $this->vm->plugin($name, $callback);
    }

    /**
     * @param ViewModel $viewModel
     * @param array $args
     * @return mixed
     */
    public function render(ViewModel $viewModel, array $args = [])
    {
        return $this->vm->render($viewModel, $args);
    }

    /**
     * @param ManagerInterface $vm
     */
    public function setViewManager(ManagerInterface $vm)
    {
        $this->vm = $vm;
    }

    /**
     * @return ManagerInterface
     */
    public function viewManager()
    {
        return $this->vm;
    }
}
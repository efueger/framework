<?php

namespace Framework\View\Manager;

use Exception;
use Framework\View\Model\ModelInterface as ViewModel;
use Framework\View\Plugin\PluginInterface;
use Framework\View\Render\RenderInterface;

trait ServiceTrait
{
    /**
     * @var ManagerInterface|PluginInterface|RenderInterface
     */
    protected $vm;

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
     * @param array $args
     * @return null|callable|object
     */
    public function plugin($name, array $args = [])
    {
        return $this->vm->plugin($name, $args);
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
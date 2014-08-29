<?php

namespace Framework\View\Manager;

use Exception;
use Framework\View\Plugin\PluginInterface;
use Framework\View\Render\RenderInterface;
use Framework\View\Model\ModelInterface as ViewModel;

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
     * @param null $args
     * @return null|callable|object
     */
    public function plugin($name, $args = null)
    {
        return $this->vm->plugin($name, $args);
    }

    /**
     * @param ViewModel $viewModel
     * @param null $options
     * @return mixed
     */
    public function render(ViewModel $viewModel, $options = null)
    {
        return $this->vm->render($viewModel, $options);
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
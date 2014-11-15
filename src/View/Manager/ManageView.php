<?php

namespace Framework\View\Manager;

use Exception;
use Framework\View\Model\ViewModel;

trait ManageView
{
    /**
     * @var ViewManager
     */
    protected $vm;

    /**
     * @param array|callable|object|string $name
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
     * @param ViewModel $model
     * @return mixed
     */
    public function render(ViewModel $model)
    {
        return $this->vm->render($model);
    }

    /**
     * @param ViewManager $vm
     */
    public function setViewManager(ViewManager $vm)
    {
        $this->vm = $vm;
    }

    /**
     * @return ViewManager
     */
    public function viewManager()
    {
        return $this->vm;
    }
}
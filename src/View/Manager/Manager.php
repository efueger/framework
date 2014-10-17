<?php

namespace Framework\View\Manager;

use Framework\Event\Manager\EventManagerInterface as EventManagerInterface;
use Framework\Event\Manager\EventsTrait as Events;
use Framework\Service\Manager\ManagerInterface as ServiceManagerInterface;
use Framework\View\Exception\EventInterface as Exception;
use Framework\View\Model\ModelInterface as ViewModel;
use Framework\View\Render\EventInterface as Render;

class Manager
    implements EventManagerInterface, ManagerInterface, ServiceManagerInterface
{
    /**
     *
     */
    use Events;

    /**
     * @param \Exception $exception
     * @param callable $callback
     * @return mixed
     */
    public function exception(\Exception $exception, callable $callback = null)
    {
        return $this->trigger([Exception::EXCEPTION, $exception], [], $callback);
    }

    /**
     * @param ViewModel $viewModel
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function render(ViewModel $viewModel, array $args = [], callable $callback = null)
    {
        return $this->trigger([Render::RENDER, $viewModel], $args, $callback);
    }
}

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
     * @return mixed
     */
    public function exception(\Exception $exception)
    {
        return $this->trigger([Exception::EXCEPTION, $exception]);
    }

    /**
     * @param ViewModel $viewModel
     * @param array $args
     * @return mixed
     */
    public function render(ViewModel $viewModel, array $args = [])
    {
        return $this->trigger([Render::RENDER, $viewModel], $args);
    }
}

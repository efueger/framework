<?php

namespace Framework\View\Manager;

use Exception;
use Framework\Event\Manager\EventManager;
use Framework\Event\Manager\Events;
use Framework\Service\Manager\ServiceManager;
use Framework\View\Exception\ViewException;
use Framework\View\Model\ViewModel;
use Framework\View\Render\Render;

class Manager
    implements EventManager, ServiceManager, ViewManager
{
    /**
     *
     */
    use Events;

    /**
     * @param Exception $exception
     * @return mixed
     */
    public function exception(Exception $exception)
    {
        return $this->trigger([ViewException::VIEW, $exception], [], $this);
    }

    /**
     * @param ViewModel $viewModel
     * @param array $args
     * @return mixed
     */
    public function render(ViewModel $viewModel, array $args = [])
    {
        return $this->trigger([Render::VIEW, $viewModel], $args, $this);
    }
}

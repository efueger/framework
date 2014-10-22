<?php

namespace Framework\View\Manager;

use Framework\Event\Manager\EventManager;
use Framework\Event\Manager\Events;
use Framework\Service\Manager\ServiceManager;
use Framework\View\Exception\ExceptionView as Exception;
use Framework\View\Model\ViewModel;
use Framework\View\Render\ViewRender as Render;

class Manager
    implements EventManager, ViewManager, ServiceManager
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
        return $this->trigger([Exception::VIEW, $exception], [], $this);
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

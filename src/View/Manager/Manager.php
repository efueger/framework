<?php

namespace Framework\View\Manager;

use Exception;
use Framework\Event\Manager\EventManager;
use Framework\Event\Manager\Events;
use Framework\Service\Manager\ServiceManager;
use Framework\View\Exception\ExceptionView;
use Framework\View\Model\ViewModel;
use Framework\View\Render\ViewRender;

class Manager
    implements EventManager, ViewManager, ServiceManager
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
        return $this->trigger([ExceptionView::VIEW, $exception], [], $this);
    }

    /**
     * @param ViewModel $viewModel
     * @param array $args
     * @return mixed
     */
    public function render(ViewModel $viewModel, array $args = [])
    {
        return $this->trigger([ViewRender::VIEW, $viewModel], $args, $this);
    }
}

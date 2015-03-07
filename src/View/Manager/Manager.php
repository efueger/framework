<?php
/**
 *
 */

namespace Mvc5\View\Manager;

use Exception;
use Mvc5\Event\Manager\EventManager;
use Mvc5\Event\Manager\Events;
use Mvc5\Service\Manager\ServiceManager;
use Mvc5\View\Exception\ViewException;
use Mvc5\View\Model\ViewModel;
use Mvc5\View\Render\Render;

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
     * @param ViewModel $model
     * @param array $args
     * @return mixed
     */
    public function render(ViewModel $model, array $args = [])
    {
        return $this->trigger([Render::VIEW, $model], $args, $this);
    }
}

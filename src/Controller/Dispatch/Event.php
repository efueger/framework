<?php

namespace Framework\Controller\Dispatch;

use Framework\Event\EventInterface as Base;
use Framework\Event\EventTrait;
use Framework\Service\Manager\ManagerInterface as ServiceManager;
use Framework\Service\Resolver\SignalTrait;

class Event
    implements Base, EventInterface
{
    /**
     *
     */
    use EventTrait;
    use SignalTrait;

    /**
     *
     */
    const EVENT = self::DISPATCH;

    /**
     * @var callable
     */
    protected $controller;

    /**
     * @var ServiceManager
     */
    protected $sm;

    /**
     * @param ServiceManager $sm
     * @param callable $controller
     */
    public function __construct(ServiceManager $sm, callable $controller)
    {
        $this->controller = $controller;
        $this->sm         = $sm;
    }

    /**
     * @return array
     */
    protected function args()
    {
        return [
            ArgsInterface::EVENT      => $this,
            ArgsInterface::CONTROLLER => $this->controller,
        ];
    }

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    public function __invoke(callable $listener, array $args = [])
    {
        return $this->signal($listener, $this->args() + $args, function($name) {
            return $this->sm->get(ucfirst($name), [], function() {});
        });
    }
}

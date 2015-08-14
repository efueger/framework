<?php
/**
 *
 */

namespace Mvc5\Service\Resolver\Event;

class Create
    implements Creator
{
    /**
     * @var array|\ArrayAccess
     */
    protected $events;

    /**
     * @param array|\ArrayAccess $events
     */
    public function __construct($events)
    {
        $this->events = $events;
    }

    /**
     * @param string $service
     * @return mixed
     */
    public function __invoke($service)
    {
        return isset($this->events[$service]) ? new Dispatch($service) : null;
    }
}

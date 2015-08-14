<?php
/**
 *
 */

namespace Mvc5\Service\Resolver\Event;

interface Creator
{
    /**
     * @param string $service
     */
    function __invoke($service);
}

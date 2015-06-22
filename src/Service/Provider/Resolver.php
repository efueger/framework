<?php
/**
 *
 */

namespace Mvc5\Service\Provider;

use Mvc5\Service\Resolver\Resolvable;

class Resolver
    implements DefaultResolver
{
    /**
     * @param Resolvable $service
     * @return Resolvable
     */
    public function __invoke(Resolvable $service)
    {
        return $service;
    }
}

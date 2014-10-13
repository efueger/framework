<?php

namespace Framework\Controller\Dispatch;

use Framework\Event\Args\ArgsInterface as EventArgsInterface;
use Framework\Event\Args\ArgsTrait;
use Framework\Service\Resolver\ArgsInterface as ServiceArgsInterface;

class Args
    implements ArgsInterface, EventArgsInterface, ServiceArgsInterface
{
    /**
     *
     */
    use ArgsTrait;
}

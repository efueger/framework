<?php

namespace Framework\Controller\Dispatch;

use Framework\Event\Args\ArgsInterface as EventArgsInterface;
use Framework\Event\Args\ArgsTrait;

class Args
    implements ArgsInterface, EventArgsInterface
{
    /**
     *
     */
    use ArgsTrait;
}

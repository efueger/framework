<?php

namespace Framework\Service\Config\ControllerAction;

use Framework\Service\Config\Base;
use Framework\Service\Resolver\Resolvable;

class ControllerAction
    implements Resolvable, ControllerService
{
    /**
     *
     */
    use Base;

    /**
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        $this->config = [
            self::ARGS => [[$args]],
            self::NAME => self::CONTROLLER_ACTION
        ];
    }
}

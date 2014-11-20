<?php

namespace Framework\Service\Config\Event;

use Framework\Service\Config\Base;
use Framework\Service\Resolver\Resolvable;

class Event
    implements Resolvable, EventService
{
    /**
     *
     */
    use Base;

    /**
     * @param string|Resolvable $name
     * @param array $args
     */
    public function __construct($name, array $args = [])
    {
        $this->config = [
            self::ARGS => [$args],
            self::NAME => $name
        ];
    }
}

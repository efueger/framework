<?php
/**
 *
 */

namespace Mvc5\Service\Config\Child;

use Mvc5\Service\Resolver\Resolvable;

class Child
    implements ChildService, Resolvable
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     * @param string $parent
     */
    public function __construct($name, $parent)
    {
        $this->config = [
            self::NAME   => $name,
            self::PARENT => $parent
        ];
    }
}

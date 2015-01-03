<?php
/**
 *
 */

namespace Framework\Service\Config\Child;

use Framework\Service\Resolver\Resolvable;

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

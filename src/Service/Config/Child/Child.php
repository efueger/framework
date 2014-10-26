<?php

namespace Framework\Service\Config\Child;

class Child
    implements ChildService
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

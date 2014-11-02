<?php

namespace Framework\Service\Config\Form;

use Framework\Service\Config\Child\Base;
use Framework\Service\Resolver\Resolvable;

class Form
    implements FormService, Resolvable
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->config = [
            self::NAME   => $name,
            self::PARENT => self::FORM
        ];
    }
}

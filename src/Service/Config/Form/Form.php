<?php

namespace Framework\Service\Config\Form;

use Framework\Service\Config\Child\Base;

class Form
    implements FormService
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

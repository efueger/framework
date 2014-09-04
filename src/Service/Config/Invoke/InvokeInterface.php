<?php

namespace Framework\Service\Config\Invoke;

use Framework\Service\Config\FactoryInterface;

interface InvokeInterface
{
    /**
     * @return string|array|FactoryInterface
     */
    public function service();
}

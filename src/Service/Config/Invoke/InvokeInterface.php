<?php

namespace Framework\Service\Config\Invoke;

use Framework\Service\Config\FactoryInterface;

interface InvokeInterface
{
    /**
     * @return array
     */
    public function args();

    /**
     * @return string|array|FactoryInterface
     */
    public function service();
}

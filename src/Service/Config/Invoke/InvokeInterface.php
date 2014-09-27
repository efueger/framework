<?php

namespace Framework\Service\Config\Invoke;

use Framework\Service\Config\ResolverInterface;

interface InvokeInterface
{
    /**
     * @return array
     */
    public function args();

    /**
     * @return string|array|ResolverInterface
     */
    public function service();
}

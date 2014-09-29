<?php

namespace Framework\Service\Config\Invoke;

interface InvokeInterface
{
    /**
     * @return array
     */
    public function args();

    /**
     * @return string|array
     */
    public function service();
}

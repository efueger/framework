<?php

namespace Framework\Service\Config\Invoke;

interface InvokeInterface
{
    /**
     * @return array
     */
    function args();

    /**
     * @return string|array
     */
    function config();
}

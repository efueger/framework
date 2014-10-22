<?php

namespace Framework\Service\Config\Invoke;

interface ServiceInvoke
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

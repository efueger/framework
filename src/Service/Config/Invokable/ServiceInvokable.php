<?php
/**
 *
 */

namespace Framework\Service\Config\Invokable;

interface ServiceInvokable
{
    /**
     * @return array|callable|object|string
     */
    function config();
}

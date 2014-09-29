<?php

namespace Framework\Service\Config\Call;

interface CallInterface
{
    /**
     * @return array
     */
    function args();

    /**
     * @return string
     */
    function config();
}

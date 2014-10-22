<?php

namespace Framework\Service\Config\Call;

interface ServiceCall
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

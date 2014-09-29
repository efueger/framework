<?php

namespace Framework\Service\Config\Filter;

interface FilterInterface
{
    /**
     * @return string
     */
    function config();

    /**
     * @return string|array
     */
    function filter();
}

<?php
/**
 *
 */

namespace Framework\Service\Config\Filter;

interface ServiceFilter
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

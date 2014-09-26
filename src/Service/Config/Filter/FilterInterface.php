<?php

namespace Framework\Service\Config\Filter;

interface FilterInterface
{
    /**
     * @return string
     */
    public function config();

    /**
     * @return string|array
     */
    public function filter();
}

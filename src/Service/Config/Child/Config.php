<?php

namespace Framework\Service\Config\Child;

interface Config
{
    /**
     *
     */
    const PARENT = 'parent';

    /**
     * @return string
     */
    function parent();
}

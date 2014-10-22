<?php

namespace Framework\Service\Config\Child;

interface ChildService
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

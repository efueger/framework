<?php

namespace Framework\Service\Config\Child;

interface ChildInterface
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

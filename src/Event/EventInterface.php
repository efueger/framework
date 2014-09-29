<?php

namespace Framework\Event;

interface EventInterface
{
    /**
     * @return string
     */
    function event();

    /**
     * @return void
     */
    function stop();

    /**
     * @return bool
     */
    function stopped();
}

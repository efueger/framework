<?php
/**
 *
 */

namespace Framework\Event;

interface Event
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

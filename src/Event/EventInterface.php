<?php

namespace Framework\Event;

interface EventInterface
{
    /**
     * @return string
     */
    public function event();

    /**
     * @return void
     */
    public function stop();

    /**
     * @return bool
     */
    public function stopped();
}

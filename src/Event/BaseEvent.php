<?php

namespace Framework\Event;

trait BaseEvent
{
    /**
     * @var string
     */
    protected $event;

    /**
     * @var bool
     */
    protected $stopped = false;

    /**
     * @return string
     */
    public function event()
    {
        return $this->event ? : static::EVENT;
    }

    /**
     *
     */
    public function stop()
    {
        $this->stopped = true;
    }

    /**
     * @return bool
     */
    public function stopped()
    {
        return $this->stopped;
    }
}

<?php

namespace Framework\Event;

trait EventTrait
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
        return isset($this->event) ? $this->event : static::EVENT;
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

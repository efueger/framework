<?php

namespace Framework\Event\Args;

trait ArgsTrait
{
    /**
     * @var array
     */
    protected $args = [];

    /**
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        $this->args = $args;
    }

    /**
     * @return array
     */
    public function args()
    {
        return $this->args;
    }
}

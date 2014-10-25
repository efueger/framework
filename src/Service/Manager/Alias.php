<?php

namespace Framework\Service\Manager;

trait Alias
{
    /**
     * @var array
     */
    protected $alias = [];

    /**
     * @param string $alias
     * @return string
     */
    public function alias($alias)
    {
        return isset($this->alias[$alias]) ? $this->alias[$alias] : null;
    }

    /**
     * @param array $alias
     */
    public function aliases(array $alias)
    {
        $this->alias = $alias;
    }
}

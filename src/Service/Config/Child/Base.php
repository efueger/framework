<?php

namespace Framework\Service\Config\Child;

use Framework\Service\Config\Base as BaseConfig;

trait Base
{
    /**
     *
     */
    use BaseConfig;

    /**
     * @return string
     */
    public function parent()
    {
        return $this->get(ChildService::PARENT);
    }
}

<?php

namespace Framework\Service\Config\Child;

use Framework\Service\Config\Configuration;

trait ChildConfig
{
    /**
     * @return string
     */
    public function parent()
    {
        /** @var Configuration $this */
        return $this->get(ChildService::PARENT);
    }
}

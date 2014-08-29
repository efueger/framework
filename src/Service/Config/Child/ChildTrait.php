<?php

namespace Framework\Service\Config\Child;

use Framework\Service\Config\ConfigInterface;

trait ChildTrait
{
    /**
     * @return string
     */
    public function parent()
    {
        /** @var ConfigInterface $this */
        return $this->get(ChildInterface::PARENT);
    }
}

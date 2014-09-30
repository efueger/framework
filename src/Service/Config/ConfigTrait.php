<?php

namespace Framework\Service\Config;

use Framework\Config\ConfigTrait as Base;

trait ConfigTrait
{
    /**
     *
     */
    use Base;

    /**
     * @return array
     */
    public function args()
    {
        return $this->get(ConfigInterface::ARGS) ? : [];
    }

    /**
     * @return array
     */
    public function calls()
    {
        return $this->get(ConfigInterface::CALLS) ? : [];
    }

    /**
     * @return bool
     */
    public function merge()
    {
        return $this->get(ConfigInterface::MERGE) ? : false;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->get(ConfigInterface::NAME);
    }
}

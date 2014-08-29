<?php

namespace Framework\Service\Config;

use Framework\Config\ConfigTrait as BaseConfigTrait;

trait ConfigTrait
{
    /**
     *
     */
    use BaseConfigTrait;

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

    /**
     * @return bool
     */
    public function shared()
    {
        return $this->get(ConfigInterface::SHARED) ? : false;
    }

    /**
     * @param string $serialized
     * @return void|ConfigInterface
     */
    public function unserialize($serialized)
    {
        $this->config = unserialize($serialized);
    }
}

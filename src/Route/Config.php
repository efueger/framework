<?php

namespace Framework\Route;

use Framework\Config\ConfigTrait as ConfigTrait;

class Config
    implements Route
{
    /**
     *
     */
    use ConfigTrait;

    /**
     * @return int
     */
    public function controller()
    {
        return $this->get(self::CONTROLLER);
    }

    /**
     * @return string|string[]
     */
    public function hostname()
    {
        return $this->get(self::HOSTNAME);
    }

    /**
     * @return int
     */
    public function length()
    {
        return $this->get(self::LENGTH) ?: 0;
    }

    /**
     * @return bool
     */
    public function matched()
    {
        return $this->get(self::MATCHED) ?: false;
    }

    /**
     * @return string|string[]
     */
    public function method()
    {
        return $this->get(self::METHOD);
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->get(self::NAME);
    }

    /**
     * @return array
     */
    public function params()
    {
        return $this->get(self::PARAMS) ?: [];
    }

    /**
     * @return string
     */
    public function path()
    {
        return $this->get(self::PATH);
    }

    /**
     * @return string|string[]
     */
    public function scheme()
    {
        return $this->get(self::SCHEME);
    }
}

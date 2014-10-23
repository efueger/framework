<?php

namespace Framework\Route\Definition;

use Framework\Config\Base;

class RouteDefinition
    implements Definition
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     * @return self
     */
    public function child($name)
    {
        return isset($this->config[self::CHILDREN][$name]) ? $this->config[self::CHILDREN][$name] : null;
    }

    /**
     * @return self[]
     */
    public function children()
    {
        return $this->get(self::CHILDREN) ?: [];
    }

    /**
     * @return array
     */
    public function constraints()
    {
        return $this->get(self::CONSTRAINTS) ?: [];
    }

    /**
     * @return array|callable|string
     */
    public function controller()
    {
        return $this->get(self::CONTROLLER);
    }

    /**
     * @return array
     */
    public function defaults()
    {
        return $this->get(self::DEFAULTS) ?: [];
    }

    /**
     * @return null|string
     */
    public function hostname()
    {
        return $this->get(self::HOSTNAME) ?: null;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->get(self::NAME);
    }

    /**
     * @return null|string
     */
    public function method()
    {
        return $this->get(self::METHOD) ?: null;
    }

    /**
     * @return array
     */
    public function paramMap()
    {
        return $this->get(self::PARAM_MAP) ?: [];
    }

    /**
     * @return string
     */
    public function regex()
    {
        return $this->get(self::REGEX);
    }

    /**
     * @return string
     */
    public function route()
    {
        return $this->get(self::ROUTE);
    }

    /**
     * @return string
     */
    public function scheme()
    {
        return $this->get(self::SCHEME);
    }

    /**
     * @return array
     */
    public function tokens()
    {
        return $this->get(self::TOKENS) ?: [];
    }

    /**
     * @return array
     */
    public function wildcard()
    {
        return $this->get(self::WILDCARD) ?: false;
    }
}

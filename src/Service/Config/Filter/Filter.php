<?php

namespace Framework\Service\Config\Filter;

class Filter
    implements ServiceFilter
{
    /**
     * @var string
     */
    protected $config;

    /**
     * @var string|array
     */
    protected $filter;

    /**
     * @param $config
     * @param $filter
     */
    public function __construct($config, $filter = null)
    {
        $this->config = $config;
        $this->filter = (array) $filter;
    }

    /**
     * @return string
     */
    public function config()
    {
        return $this->config;
    }

    /**
     * @return string|array
     */
    public function filter()
    {
        return $this->filter;
    }
}

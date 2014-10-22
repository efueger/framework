<?php

namespace Framework\Application;

use Framework\Config\Configuration;

class Web
    implements WebApplication
{
    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     */
    public function __invoke(array $args = [], callable $callback = null)
    {
        return (new App($this->config))->call(self::WEB, $args, $callback);
    }
}

<?php

namespace Framework\Application;

use Framework\Config\ConfigInterface as Config;

class Web
    implements WebInterface
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
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
        return (new Application($this->config))->call(self::WEB, $args, $callback);
    }
}

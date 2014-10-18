<?php

namespace Framework\Application;

use Framework\Config\ConfigInterface as Config;

class Web
    implements WebInterface
{
    /**
     * @var ApplicationInterface
     */
    protected $application;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->application = new Application($config);
    }

    /**
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     */
    public function __invoke(array $args = [], callable $callback = null)
    {
        return $this->application->call(self::WEB, $args, $callback);
    }
}

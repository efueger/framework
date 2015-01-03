<?php
/**
 *
 */

namespace Framework\Service\Config\Invoke;

use Framework\Service\Resolver\Resolvable;

class Invoke
    implements Resolvable, ServiceInvoke
{
    /**
     * @var array
     */
    protected $args = [];

    /**
     * @var string|array
     */
    protected $config;

    /**
     * @param string|array $config
     * @param array $args
     */
    public function __construct($config, array $args = [])
    {
        $this->args   = $args;
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function args()
    {
        return $this->args;
    }

    /**
     * @return string|array
     */
    public function config()
    {
        return $this->config;
    }
}

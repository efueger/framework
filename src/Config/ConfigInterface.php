<?php

namespace Framework\Config;

use Serializable;

interface ConfigInterface
    extends Serializable
{
    /**
     * @param string $name
     * @param mixed $config
     * @return void
     */
    public function add($name, $config);

    /**
     * @return array
     */
    public function config();

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name);

    /**
     * @param string $name
     * @return bool
     */
    public function has($name);

    /**
     * @param string $name
     * @return void
     */
    public function remove($name);
}

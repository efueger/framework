<?php

namespace Framework\Config;

interface ConfigInterface
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

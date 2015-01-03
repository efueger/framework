<?php
/**
 *
 */

namespace Framework\Config;

trait ArrayAccess
{
    /**
     * @param string $name
     * @return mixed
     */
    public abstract function get($name);

    /**
     * @param string $name
     * @return bool
     */
    public abstract function has($name);

    /**
     * @param mixed $config
     * @return bool
     */
    public function offsetExists($config)
    {
        return $this->has($config);
    }

    /**
     * @param mixed $config
     * @return mixed
     */
    public function offsetGet($config)
    {
        return $this->get($config);
    }

    /**
     * @param mixed $config
     * @param mixed $value
     */
    public function offsetSet($config, $value)
    {
        $this->set($config, $value);
    }

    /**
     * @param mixed $config
     */
    public function offsetUnset($config)
    {
        $this->remove($config);
    }

    /**
     * @param string $name
     * @return void
     */
    public abstract function remove($name);

    /**
     * @param string $name
     * @param mixed $config
     * @return void
     */
    public abstract function set($name, $config);
}

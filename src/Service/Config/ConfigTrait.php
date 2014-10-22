<?php

namespace Framework\Service\Config;

use Framework\Config\ConfigTrait as Base;

trait ConfigTrait
{
    /**
     *
     */
    use Base;

    /**
     * @return array
     */
    public function args()
    {
        return $this->get(Configuration::ARGS) ? : [];
    }

    /**
     * @return array
     */
    public function calls()
    {
        return $this->get(Configuration::CALLS) ? : [];
    }

    /**
     * @return bool
     */
    public function merge()
    {
        return $this->get(Configuration::MERGE) ? : false;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->get(Configuration::NAME);
    }
}

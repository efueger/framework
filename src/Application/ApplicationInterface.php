<?php

namespace Framework\Application;

interface ApplicationInterface
{
    /**
     *
     */
    const LISTENERS = 'listeners';

    /**
     *
     */
    const SERVICES = 'services';

    /**
     * @param null $options
     * @return mixed
     */
    public function run($options = null);
}

<?php

namespace Framework\Application;

interface ApplicationInterface
{
    /**
     *
     */
    const EVENTS = 'events';

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

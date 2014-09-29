<?php

namespace Framework\Service\Provider;

interface ProviderInterface
{
    /**
     * @param array|object|string $config
     * @param array $args
     * @return null|object
     */
    public function create($config, array $args = []);
}

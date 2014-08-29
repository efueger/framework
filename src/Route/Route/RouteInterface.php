<?php

namespace Framework\Route\Route;

use Framework\Config\ConfigInterface;

interface RouteInterface
    extends ConfigInterface
{
    /**
     *
     */
    const CONTROLLER = 'controller';

    /**
     *
     */
    const HOSTNAME = 'hostname';

    /**
     *
     */
    const LENGTH = 'length';

    /**
     *
     */
    const MATCHED = 'matched';

    /**
     *
     */
    const METHOD = 'method';

    /**
     *
     */
    const NAME = 'name';

    /**
     *
     */
    const PARAMS = 'params';

    /**
     *
     */
    const PATH = 'path';

    /**
     *
     */
    const SCHEME = 'scheme';


    /**
     * @return string
     */
    public function controller();

    /**
     * @return string|string[]
     */
    public function hostname();

    /**
     * @return int
     */
    public function length();

    /**
     * @return bool
     */
    public function matched();

    /**
     * @return string|string[]
     */
    public function method();

    /**
     * @return string
     */
    public function name();

    /**
     * @return array
     */
    public function params();

    /**
     * @return string
     */
    public function path();

    /**
     * @return string|string[]
     */
    public function scheme();
}

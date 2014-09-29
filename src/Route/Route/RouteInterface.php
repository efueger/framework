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
    function controller();

    /**
     * @return string|string[]
     */
    function hostname();

    /**
     * @return int
     */
    function length();

    /**
     * @return bool
     */
    function matched();

    /**
     * @return string|string[]
     */
    function method();

    /**
     * @return string
     */
    function name();

    /**
     * @return array
     */
    function params();

    /**
     * @return string
     */
    function path();

    /**
     * @return string|string[]
     */
    function scheme();
}

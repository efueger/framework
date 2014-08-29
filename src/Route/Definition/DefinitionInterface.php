<?php

namespace Framework\Route\Definition;

use Framework\Config\ConfigInterface;

interface DefinitionInterface
    extends ConfigInterface
{
    /**
     *
     */
    const CHILDREN = 'children';

    /**
     *
     */
    const CONSTRAINTS = 'constraints';

    /**
     *
     */
    const CONTROLLER = 'controller';

    /**
     *
     */
    const DEFAULTS = 'defaults';

    /**
     *
     */
    const HOSTNAME = 'hostname';

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
    const PARAM_MAP = 'paramMap';

    /**
     *
     */
    const REGEX = 'regex';

    /**
     *
     */
    const ROUTE = 'route';

    /**
     *
     */
    const SCHEME = 'scheme';

    /**
     *
     */
    const TOKENS = 'tokens';

    /**
     *
     */
    const WILDCARD = 'wildcard';

    /**
     * @param string $name
     * @return self
     */
    public function child($name);

    /**
     * @return self[]
     */
    public function children();

    /**
     * @return array
     */
    public function constraints();

    /**
     * @return string
     */
    public function controller();

    /**
     * @return array
     */
    public function defaults();

    /**
     * @return array|string
     */
    public function hostname();

    /**
     * @return string
     */
    public function method();

    /**
     * @return string
     */
    public function name();

    /**
     * @return string
     */
    public function paramMap();

    /**
     * @return string
     */
    public function regex();

    /**
     * @return string
     */
    public function route();

    /**
     * @return string
     */
    public function scheme();

    /**
     * @return array
     */
    public function tokens();

    /**
     * @return true
     */
    public function wildcard();
}

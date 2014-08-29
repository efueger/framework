<?php

namespace Framework\Service\Config;

use Framework\Config\ConfigInterface as BaseConfig;

interface ConfigInterface
    extends BaseConfig
{
    /**
     *
     */
    const ARGS = 'args';

    /**
     *
     */
    const CALLS = 'calls';

    /**
     *
     */
    const MERGE = 'merge';

    /**
     *
     */
    const NAME = 'name';

    /**
     *
     */
    const SHARED = 'shared';

    /**
     * @return array
     */
    public function args();

    /**
     * @return array
     */
    public function calls();

    /**
     * @return bool
     */
    public function merge();

    /**
     * @return string
     */
    public function name();

    /**
     * @return bool
     */
    public function shared();
}

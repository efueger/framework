<?php

namespace Framework\Service\Config;

use Framework\Config\ConfigInterface as Base;

interface ConfigInterface
    extends Base
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
     * @return array
     */
    function args();

    /**
     * @return array
     */
    function calls();

    /**
     * @return bool
     */
    function merge();

    /**
     * @return string
     */
    function name();
}

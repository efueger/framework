<?php

namespace Framework\Service\Config;

use Framework\Config\Configuration as Base;

interface Configuration
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

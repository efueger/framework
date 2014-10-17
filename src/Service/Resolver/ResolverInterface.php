<?php

namespace Framework\Service\Resolver;

interface ResolverInterface
{
    /**
     *
     */
    const ARGS = 'args';

    /**
     *
     */
    const PROPERTY = '$';

    /**
     *
     */
    const CALL = '@';

    /**
     *
     */
    const CALL_SEPARATOR = '.';

    /**
     *
     */
    const CALLABLE_STRING = '::';
}

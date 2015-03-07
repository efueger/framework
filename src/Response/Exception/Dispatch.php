<?php
/**
 *
 */

namespace Mvc5\Response\Exception;

use Mvc5\Response\Response;

interface Dispatch
{
    /**
     * @return Response
     */
    function __invoke();
}

<?php
/**
 *
 */

namespace Framework\Response\Exception;

use Framework\Response\Response;

interface Dispatch
{
    /**
     * @return Response
     */
    function __invoke();
}

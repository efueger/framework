<?php
/**
 *
 */

namespace Mvc5\Response\Exception;

use Mvc5\Response\Response;

interface Render
{
    /**
     * @param \Exception $exception
     * @param Response $response
     * @return Response
     */
    function __invoke(\Exception $exception, Response $response);
}

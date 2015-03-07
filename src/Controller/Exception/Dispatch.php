<?php
/**
 *
 */

namespace Mvc5\Controller\Exception;

use Exception as ExceptionInterface;
use Mvc5\Response\Response;

interface Dispatch
{
    /**
     * @param ExceptionInterface $exception
     * @param Response $response
     * @return mixed
     */
    function __invoke(ExceptionInterface $exception, Response $response);
}

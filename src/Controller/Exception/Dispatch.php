<?php
/**
 *
 */

namespace Framework\Controller\Exception;

use Exception as ExceptionInterface;
use Framework\Response\Response;

interface Dispatch
{
    /**
     * @param ExceptionInterface $exception
     * @param Response $response
     * @return mixed
     */
    function __invoke(ExceptionInterface $exception, Response $response);
}

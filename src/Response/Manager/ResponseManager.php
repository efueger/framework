<?php
/**
 *
 */

namespace Mvc5\Response\Manager;

use Exception;
use Mvc5\Response\Response;

interface ResponseManager
{
    /**
     * @param Response $response
     * @param Exception $exception
     * @return Response
     */
    function exception(Response $response, Exception $exception);

    /**
     * @param Response $response
     * @return mixed
     */
    function send(Response $response);
}

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
     * @param Exception $exception
     * @return Response
     */
    function exception(Exception $exception);

    /**
     * @param Response $response
     * @return mixed
     */
    function send(Response $response);
}

<?php
/**
 *
 */

namespace Mvc5\Response\Manager;

use Exception;
use Mvc5\Event\Manager\EventManager;
use Mvc5\Event\Manager\Events;
use Mvc5\Response\Exception\ResponseException;
use Mvc5\Response\Dispatch\DispatchResponse;
use Mvc5\Response\Response;
use Mvc5\Service\Manager\ServiceManager;

class Manager
    implements EventManager, ResponseManager, ServiceManager
{
    /**
     *
     */
    use Events;

    /**
     * @param Exception $exception
     * @return Response
     */
    public function exception(Exception $exception)
    {
        return $this->trigger([ResponseException::EXCEPTION, $exception], [], $this);
    }

    /**
     * @param Response $response
     * @return mixed
     */
    public function send(Response $response)
    {
        return $this->trigger([DispatchResponse::DISPATCH, $response], [], $this);
    }
}

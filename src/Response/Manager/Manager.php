<?php
/**
 *
 */

namespace Framework\Response\Manager;

use Exception;
use Framework\Event\Manager\EventManager;
use Framework\Event\Manager\Events;
use Framework\Response\Exception\ResponseException;
use Framework\Response\Dispatch\DispatchResponse;
use Framework\Response\Response;
use Framework\Service\Manager\ServiceManager;

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

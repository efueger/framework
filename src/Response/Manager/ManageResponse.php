<?php
/**
 *
 */

namespace Mvc5\Response\Manager;

use Exception;
use Mvc5\Response\Response;

trait ManageResponse
{
    /**
     * @var ResponseManager
     */
    protected $rm;

    /**
     * @param Exception $exception
     * @return Response
     */
    public function exception(Exception $exception)
    {
        return $this->rm->exception($exception);
    }

    /**
     * @param Response $response
     * @return mixed
     */
    public function send(Response $response)
    {
        return $this->rm->send($response);
    }

    /**
     * @param  ResponseManager $rm
     */
    public function setResponseManager(ResponseManager $rm)
    {
        $this->rm = $rm;
    }

    /**
     * @return ResponseManager
     */
    public function responseManager()
    {
        return $this->rm;
    }
}

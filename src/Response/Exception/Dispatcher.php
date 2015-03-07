<?php
/**
 *
 */

namespace Mvc5\Response\Exception;

use Mvc5\Response\Response;

class Dispatcher
    implements Dispatch
{
    /**
     * @var Response $response
     */
    protected $response;

    /**
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        return $this->response;
    }
}

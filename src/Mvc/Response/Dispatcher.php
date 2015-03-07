<?php
/**
 *
 */

namespace Mvc5\Mvc\Response;

use Exception;
use Mvc5\Response\Manager\ManageResponse;
use Mvc5\Response\Response;

class Dispatcher
    implements Dispatch
{
    /**
     *
     */
    use ManageResponse;

    /**
     * @param Response $response
     * @return mixed
     */
    public function __invoke(Response $response)
    {
        try {

            return $this->send($response);

        } catch(Exception $exception) {

            return $this->send($this->exception($exception));

        }
    }
}

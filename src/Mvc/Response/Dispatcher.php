<?php
/**
 *
 */

namespace Framework\Mvc\Response;

use Exception;
use Framework\Response\Manager\ManageResponse;
use Framework\Response\Response;

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

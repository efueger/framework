<?php
/**
 *
 */

namespace Framework\Response\Send;

use Framework\Response\Response;

class Sender
    implements Send
{
    /**
     * @param Response $response
     * @return mixed
     */
    public function __invoke(Response $response)
    {
        $response->send();
    }
}

<?php

namespace Framework\Response;

use Framework\Event\EventInterface as Event;
use Framework\Response\ResponseInterface as Response;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const RESPONSE = 'Response\Event';

    /**
     * @return Response
     */
    public function response();
}

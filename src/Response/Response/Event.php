<?php

namespace Framework\Response\Response;

class Event
    implements EventInterface
{
    /**
     *
     */
    use EventTrait;

    /**
     *
     */
    const EVENT = self::RESPONSE;
}

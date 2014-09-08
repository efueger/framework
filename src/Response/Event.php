<?php

namespace Framework\Response;

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

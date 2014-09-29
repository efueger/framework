<?php

namespace Framework\Mvc;

use Framework\Route\Route\RouteInterface as Route;
use Framework\Mvc\Render\ListenerInterface as Render;
use Framework\View\Model\ServiceTrait as ViewModelTrait;
use Framework\Response\ResponseInterface as Response;
use Framework\View\Model\ModelInterface as ViewModel;

class Event
    implements EventInterface
{
    /**
     *
     */
    use EventTrait,
        ViewModelTrait;

    /**
     *
     */
    const EVENT = self::MVC;

    /**
     * @param callable $listener
     * @param array $options
     * @return mixed
     */
    public function __invoke(callable $listener, array $options = [])
    {
        $response = $listener($this, $options);

        switch(true) {
            default:
                break;
            case $response instanceof Route:

                $this->setRoute($response);

                break;
            case $response instanceof Response:

                $this->setResponse($response);

                break;
            case $response instanceof ViewModel:

                $this->setViewModel($response);

                break;
            case $listener instanceof Render:

                $this->setResponseContent($response);

                break;
        }

        return $response;
    }
}

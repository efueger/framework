<?php

namespace Framework\Mvc;

use Framework\Mvc\Render\ListenerInterface as Render;
use Framework\Response\ResponseInterface as Response;
use Framework\Route\Route\RouteInterface as Route;
use Framework\Event\Signal\SignalInterface;
use Framework\View\Model\ModelInterface as ViewModel;

class Event
    implements EventInterface, SignalInterface
{
    /**
     *
     */
    use EventTrait;

    /**
     *
     */
    const EVENT = self::MVC;

    /**
     * @return Args
     */
    public function args()
    {
        return new Args([
            'event'         => $this,
            self::REQUEST   => $this->request(),
            self::RESPONSE  => $this->response(),
            self::ROUTE     => $this->route(),
            self::VIEWMODEL => $this->viewModel()
        ]);
    }

    /**
     * @param callable $listener
     * @param array $options
     * @return mixed
     */
    public function __invoke(callable $listener, array $options = [])
    {
        $response = $this->signal($listener, [$this->args()]);

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

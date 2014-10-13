<?php

namespace Framework\Mvc;

use Framework\Mvc\Render\ListenerInterface as Render;
use Framework\Response\ResponseInterface as Response;
use Framework\Route\Route\RouteInterface as Route;
use Framework\View\Model\ModelInterface as ViewModel;

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
    const EVENT = self::MVC;

    /**
     * @return array
     */
    public function args()
    {
        return [
            ArgsInterface::EVENT      => $this,
            ArgsInterface::REQUEST    => $this->request(),
            ArgsInterface::RESPONSE   => $this->response(),
            ArgsInterface::ROUTE      => $this->route(),
            ArgsInterface::VIEWMODEL  => $this->viewModel(),
            ArgsInterface::CONTROLLER => $this->route()->controller(),
        ];
    }

    /**
     * @param callable $listener
     * @param array $options
     * @return mixed
     */
    public function __invoke(callable $listener, array $options = [])
    {
        $response = $this->signal($listener, $this->args());

        if ($response instanceof Route) {
            $this->setRoute($response);
        }

        if ($response instanceof Response) {
            $this->setResponse($response);
        }

        if ($response instanceof ViewModel) {
            $this->setViewModel($response);
        }

        if ($listener instanceof Render) {
            $this->setResponseContent($response);
        }

        return $response;
    }
}

<?php

namespace Framework\Mvc;

use Framework\Event\EventInterface as Base;
use Framework\Mvc\Render\ListenerInterface as Render;
use Framework\Response\ResponseInterface as Response;
use Framework\Route\Route\RouteInterface as Route;
use Framework\View\Model\ModelInterface as ViewModel;

class Event
    implements Base, EventInterface
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
    protected function params()
    {
        return [
            ArgsInterface::EVENT      => $this,
            ArgsInterface::REQUEST    => $this->request(),
            ArgsInterface::RESPONSE   => $this->response(),
            ArgsInterface::ROUTE      => $this->route(),
            ArgsInterface::VIEW_MODEL => $this->viewModel(),
            ArgsInterface::CONTROLLER => $this->route()->controller()
        ];
    }

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    public function __invoke(callable $listener, array $args = [])
    {
        $response = $this->signal($listener, $this->params(), null, function($name) {
            return $this->sm->get(ucfirst($name), [], function() {});
        });

        if ($response instanceof Route) {
            $this->setRoute($response);
            return $response;
        }

        if ($response instanceof Response) {
            $this->setResponse($response);
            return $response;
        }

        if ($response instanceof ViewModel) {
            $this->setViewModel($response);
            return $response;
        }

        if ($listener instanceof Render) {
            $this->setResponseContent($response);
            return $response;
        }

        return $response;
    }
}

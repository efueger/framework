<?php

namespace Framework\Mvc;

use Framework\Event\Event;
use Framework\Mvc\View\ViewRenderer;
use Framework\Response\ResponseInterface as Response;
use Framework\Route\Route;
use Framework\View\Model\ViewModel;

class MvcEvent
    implements Event, Mvc
{
    /**
     *
     */
    use ServiceTrait;

    /**
     *
     */
    const EVENT = self::MVC;

    /**
     * @return array
     */
    protected function args()
    {
        return [
            Args::EVENT      => $this,
            Args::RESPONSE   => $this->response(),
            Args::ROUTE      => $this->route(),
            Args::VIEW_MODEL => $this->viewModel(),
            Args::CONTROLLER => $this->route()->controller()
        ];
    }

    /**
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function __invoke(callable $listener, array $args = [], callable $callback = null)
    {
        $response = $this->signal($listener, $this->args() + $args, $callback);

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

        if ($listener instanceof ViewRenderer) {
            $this->setResponseContent($response);
            return $response;
        }

        return $response;
    }
}

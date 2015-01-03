<?php
/**
 *
 */

namespace Framework\Mvc;

use Framework\Event\Event;
use Framework\Response\Response;
use Framework\Route\Route;

class Mvc
    implements Dispatch, Event
{
    /**
     *
     */
    use Base;

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
            Args::MODEL      => $this->model(),
            Args::CONTROLLER => $this->controller()
        ];
    }

    /**
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function __invoke(callable $callable, array $args = [], callable $callback = null)
    {
        $response = $this->signal($callable, $this->args() + $args, $callback);

        if ($response instanceof Route) {
            $this->setRoute($response);
            return $response;
        }

        if ($response instanceof Response) {
            $this->setResponse($response);
            return $response;
        }

        $response && $this->setModel($response);

        return $response;
    }
}

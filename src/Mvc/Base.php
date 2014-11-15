<?php

namespace Framework\Mvc;

use Framework\Event\Base as Event;
use Framework\Service\Resolver\Signal;
use Framework\Response\Response;
use Framework\Route\Route;
use Framework\Config\Configuration;

trait Base
{
    /**
     *
     */
    use Event;
    use Signal;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * @return callable|object|null|string
     */
    protected function controller()
    {
        return $this->route()->controller();
    }

    /**
     * @return array|callable|null|object|string
     */
    protected function model()
    {
        return $this->response()->content();
    }

    /**
     * @return Response
     */
    protected function response()
    {
        return $this->config->get(Dispatch::RESPONSE);
    }

    /**
     * @return Route
     */
    protected function route()
    {
        return $this->config->get(Dispatch::ROUTE);
    }

    /**
     * @param $model
     * @return void
     */
    protected function setModel($model)
    {
        $this->response()->setContent($model);
    }

    /**
     * @param Response $response
     * @return void
     */
    protected function setResponse(Response $response)
    {
        $this->config->set(Dispatch::RESPONSE, $response);
    }

    /**
     * @param Route $route
     * @return void
     */
    protected function setRoute(Route $route)
    {
        $this->config->set(Dispatch::ROUTE, $route);
    }
}

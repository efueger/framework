<?php

namespace Framework\Mvc;

use Framework\Event\EventTrait as Event;
use Framework\Service\Resolver\SignalTrait as Signal;
use Framework\Response\ResponseInterface as Response;
use Framework\Route\RouteInterface as Route;
use Framework\Service\Manager\ManagerInterface as ServiceManager;
use Framework\View\Model\ServiceTrait as ViewModel;

trait ServiceTrait
{
    /**
     *
     */
    use Event;
    use Signal;
    use ViewModel;

    /**
     * @var ServiceManager
     */
    protected $sm;

    /**
     * @param ServiceManager $sm
     */
    public function __construct(ServiceManager $sm)
    {
        $this->sm = $sm;
    }

    /**
     * @return Response
     */
    public function response()
    {
        return $this->sm->get(MvcInterface::RESPONSE);
    }

    /**
     * @return Route
     */
    public function route()
    {
        return $this->sm->get(MvcInterface::ROUTE);
    }

    /**
     * @param Response $response
     */
    protected function setResponse(Response $response)
    {
        $this->sm->set(MvcInterface::RESPONSE, $response);
    }

    /**
     * @param $content
     */
    protected function setResponseContent($content)
    {
        $this->response()->setContent($content);
    }

    /**
     * @param Route $route
     * @return self
     */
    protected function setRoute(Route $route)
    {
        $this->sm->set(MvcInterface::ROUTE, $route);
    }
}

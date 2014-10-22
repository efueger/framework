<?php

namespace Framework\Mvc;

use Framework\Event\EventTrait as Event;
use Framework\Service\Resolver\SignalTrait as Signal;
use Framework\Response\Response;
use Framework\Route\Route;
use Framework\Service\Manager\ServiceManager;
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
        return $this->sm->get(MvcEvent::RESPONSE);
    }

    /**
     * @return Route
     */
    public function route()
    {
        return $this->sm->get(MvcEvent::ROUTE);
    }

    /**
     * @param Response $response
     */
    protected function setResponse(Response $response)
    {
        $this->sm->set(MvcEvent::RESPONSE, $response);
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
        $this->sm->set(MvcEvent::ROUTE, $route);
    }
}

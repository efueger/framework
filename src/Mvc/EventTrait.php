<?php

namespace Framework\Mvc;

use Framework\Event\EventTrait as Event;
use Framework\Request\RequestInterface as Request;
use Framework\Response\ResponseInterface as Response;
use Framework\Route\Route\RouteInterface as Route;
use Framework\Service\Manager\ManagerInterface as ServiceManager;
use Framework\View\Model\ServiceTrait as ViewModel;

trait EventTrait
{
    /**
     *
     */
    use Event;
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
     * @return array
     */
    public function args()
    {
        return [
            EventInterface::REQUEST  => $this->request(),
            EventInterface::RESPONSE => $this->response()
        ];
    }

    /**
     * @return Request
     */
    public function request()
    {
        return $this->sm->get(EventInterface::REQUEST);
    }

    /**
     * @return Response
     */
    public function response()
    {
        return $this->sm->get(EventInterface::RESPONSE);
    }

    /**
     * @return Route
     */
    public function route()
    {
        return $this->sm->get(EventInterface::ROUTE);
    }

    /**
     * @param Request $request
     */
    protected function setRequest(Request $request)
    {
        $this->sm->add(EventInterface::REQUEST, $request);
    }

    /**
     * @param Response $response
     */
    protected function setResponse(Response $response)
    {
        $this->sm->add(EventInterface::RESPONSE, $response);
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
        $this->sm->add(EventInterface::ROUTE, $route);
    }
}

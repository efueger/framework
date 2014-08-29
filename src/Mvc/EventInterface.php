<?php

namespace Framework\Mvc;

use Framework\Event\EventInterface as Event;
use Framework\Route\Route\RouteInterface as Route;
use Framework\Request\RequestInterface as Request;
use Framework\Response\ResponseInterface as Response;
use Framework\View\Model\ModelInterface as ViewModel;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const MVC = 'Mvc\Event';

    /**
     *
     */
    const REQUEST = 'Request';

    /**
     *
     */
    const RESPONSE = 'Response';

    /**
     *
     */
    const ROUTE = 'Route';

    /**
     *
     */
    const VIEW_MODEL = 'View\Model';

    /**
     * @return Request
     */
    public function request();

    /**
     * @return Response
     */
    public function response();

    /**
     * @return Route
     */
    public function route();

    /**
     * @return ViewModel
     */
    public function viewModel();
}

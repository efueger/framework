<?php

namespace Framework\Mvc;

use Framework\Route\Route\RouteInterface as Route;
use Framework\Response\ResponseInterface as Response;
use Framework\View\Model\ModelInterface as ViewModel;

interface EventInterface
{
    /**
     *
     */
    const MVC = 'Mvc\Event';

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
    const VIEW_MODEL = 'ViewModel';

    /**
     * @return Response
     */
    function response();

    /**
     * @return Route
     */
    function route();

    /**
     * @return ViewModel
     */
    function viewModel();

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}

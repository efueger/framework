<?php

namespace Framework\Mvc;

use Framework\Route\Route\RouteInterface as Route;
use Framework\Response\ResponseInterface as Response;
use Framework\View\Model\ModelInterface as ViewModel;

interface MvcInterface
{
    /**
     *
     */
    const MVC = 'Mvc';

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
     * @param callable $callback
     * @return mixed
     */
    function __invoke(callable $listener, array $args = [], callable $callback = null);
}

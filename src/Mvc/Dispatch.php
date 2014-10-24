<?php

namespace Framework\Mvc;

use Framework\Route\Route;
use Framework\Response\Response;
use Framework\View\Model\ViewModel;

interface Dispatch
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
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke(callable $callable, array $args = [], callable $callback = null);
}

<?php
/**
 *
 */

namespace Mvc5\Route\Exception;

use Mvc5\View\Exception\ExceptionModel;
use Mvc5\View\Model\ViewModel as Model;
use Mvc5\View\ViewModel;

class Controller
    implements Dispatch
{
    /**
     *
     */
    use ViewModel;

    /**
     * @param RouteException $route
     * @return Model
     */
    public function __invoke(RouteException $route)
    {
        return $this->model([ExceptionModel::EXCEPTION => $route->exception()]);
    }
}

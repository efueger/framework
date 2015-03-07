<?php
/**
 *
 */

namespace Mvc5\Controller\Exception;

use Mvc5\Response\Response;
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
     * @param \Exception $exception
     * @param Response $response
     * @return Model
     */
    public function __invoke(\Exception $exception, Response $response)
    {
        $response->setStatus(500);

        return $this->model([ExceptionModel::EXCEPTION => $exception]);
    }
}

<?php
/**
 *
 */

namespace Framework\Controller\Exception;

use Framework\Response\Response;
use Framework\View\Exception\ExceptionModel;
use Framework\View\Model\ViewModel as Model;
use Framework\View\ViewModel;

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

<?php
/**
 *
 */

namespace Mvc5\Response\Exception;

use Exception as ExceptionInterface;
use Mvc5\Response\Response;
use Mvc5\View\Manager\ManageView;

class Renderer
    implements Render
{
    /**
     *
     */
    use ManageView;

    /**
     * @param ExceptionInterface $exception
     * @param Response $response
     * @return Response
     */
    public function __invoke(ExceptionInterface $exception, Response $response)
    {
        $response->setContent($this->exception($exception));
        return $response;
    }
}

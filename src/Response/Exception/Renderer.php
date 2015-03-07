<?php
/**
 *
 */

namespace Mvc5\Response\Exception;

use Exception as ExceptionInterface;
use Mvc5\Response\Response;
use Mvc5\View\Manager\ViewManager;

class Renderer
    implements Render
{
    /**
     * @param ExceptionInterface $exception
     * @param Response $response
     * @param ViewManager $vm
     * @return Response
     */
    public function __invoke(ExceptionInterface $exception, Response $response, ViewManager $vm)
    {
        $response->setContent($vm->exception($exception));
        return $response;
    }
}

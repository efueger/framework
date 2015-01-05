<?php
/**
 *
 */

namespace Framework\Response\Exception;

use Exception as ExceptionInterface;
use Framework\Response\Response;
use Framework\View\Manager\ViewManager;

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

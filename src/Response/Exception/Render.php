<?php
/**
 *
 */

namespace Mvc5\Response\Exception;

use Exception as ExceptionInterface;
use Mvc5\Response\Response;
use Mvc5\View\Manager\ViewManager;

interface Render
{
    /**
     * @param ExceptionInterface $exception
     * @param Response $response
     * @param ViewManager $vm
     * @return Response
     */
    function __invoke(ExceptionInterface $exception, Response $response, ViewManager $vm);
}

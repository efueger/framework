<?php
/**
 *
 */

namespace Framework\Response\Exception;

use Exception as ExceptionInterface;
use Framework\Response\Response;
use Framework\View\Manager\ViewManager;

interface Render
{
    /**
     * @param ExceptionInterface $exception
     * @param Response $response
     * @param ViewManager $vm
     * @return mixed
     */
    function __invoke(ExceptionInterface $exception, Response $response, ViewManager $vm);
}

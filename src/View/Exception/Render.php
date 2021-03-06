<?php
/**
 *
 */

namespace Mvc5\View\Exception;

use Exception;

interface Render
{
    /**
     * @param Exception $exception
     * @param ExceptionModel $model
     * @return mixed
     */
    function __invoke(Exception $exception, ExceptionModel $model);
}

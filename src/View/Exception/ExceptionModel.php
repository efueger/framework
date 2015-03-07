<?php
/**
 *
 */

namespace Mvc5\View\Exception;

use Exception;
use Mvc5\View\Layout\LayoutModel;

interface ExceptionModel
    extends LayoutModel
{
    /**
     *
     */
    const EXCEPTION = 'exception';

    /**
     * @param Exception $exception
     * @return mixed
     */
    function exception(Exception $exception);
}

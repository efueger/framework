<?php

namespace Framework\View\Exception;

use Exception;
use Framework\View\Layout\LayoutModel;

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

<?php

namespace Framework\View\Exception;

use Exception;
use Framework\View\Model\ViewModel;

interface ExceptionModel
    extends ViewModel
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

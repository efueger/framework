<?php

namespace Framework\View\Exception;

use Exception;
use Framework\View\Model\ViewModel;

interface ExceptionViewModel
    extends ViewModel
{
    /**
     * @param Exception $exception
     * @return mixed
     */
    function setException(Exception $exception);

    /**
     * @param $message
     */
    function setMessage($message);
}

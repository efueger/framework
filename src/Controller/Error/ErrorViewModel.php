<?php

namespace Framework\Controller\Error;

use Framework\View\Model\ViewModel;

interface ErrorViewModel
    extends ViewModel
{
    /**
     * @param $message
     */
    function setMessage($message);
}

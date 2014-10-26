<?php

namespace Framework\Controller\Error;

use Framework\View\Model\ViewModel;

interface ErrorModel
    extends ViewModel
{
    /**
     * @param $message
     */
    function setMessage($message);
}
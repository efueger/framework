<?php

namespace Framework\Controller\Error;

use Framework\View\Model\ModelInterface;

interface ViewModelInterface
    extends ModelInterface
{
    /**
     * @param $message
     */
    function setMessage($message);
}

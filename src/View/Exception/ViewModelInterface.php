<?php

namespace Framework\View\Exception;

use Exception;
use Framework\View\Model\ModelInterface;

interface ViewModelInterface
    extends ModelInterface
{
    /**
     * @param Exception $exception
     * @return mixed
     */
    public function setException(Exception $exception);

    /**
     * @param $message
     */
    public function setMessage($message);
}

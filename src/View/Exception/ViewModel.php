<?php

namespace Framework\View\Exception;

use Exception;
use Framework\View\Layout\Layout;
use Framework\View\Model\BaseModel;

class ViewModel
    implements Layout, ExceptionViewModel
{
    /**
     *
     */
    use BaseModel;

    /**
     * @var Exception
     */
    public $exception;

    /**
     * @var string
     */
    public $message;

    /**
     * @param Exception $exception
     * @return mixed
     */
    public function setException(Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @param $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}

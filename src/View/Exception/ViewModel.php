<?php

namespace Framework\View\Exception;

use Exception;
use Framework\View\Layout\LayoutInterface;
use Framework\View\Model\ModelTrait;

class ViewModel
    implements LayoutInterface, ViewModelInterface
{
    /**
     *
     */
    use ModelTrait;

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

<?php

namespace Framework\Controller\Error;

use Framework\View\Model\Base;
use Framework\View\ViewPlugin;

class Model
    implements ErrorModel
{
    /**
     *
     */
    use Base;
    use ViewPlugin;

    /**
     * @var string
     */
    public $message = 'A 404 error occurred';

    /**
     * @param $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}

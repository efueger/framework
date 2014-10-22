<?php

namespace Framework\Controller\Error;

use Framework\View\Model\BaseModel;
use Framework\View\ViewPlugin;

class ViewModel
    implements ErrorViewModel
{
    /**
     *
     */
    use BaseModel;
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

<?php

namespace Framework\Controller\Error;

use Framework\View\Model\ModelTrait;
use Framework\View\PluginTrait;

class ViewModel
    implements ViewModelInterface
{
    /**
     *
     */
    use ModelTrait;
    use PluginTrait;

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

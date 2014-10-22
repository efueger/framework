<?php

namespace Framework\View\Model;

trait BaseModel
{
    /**
     * @var string
     */
    public $__content;

    /**
     * @var string
     */
    protected $__template;

    /**
     * @return string
     */
    public function content()
    {
        return $this->__content;
    }

    /**
     * @param $content
     * @return void
     */
    public function setContent($content)
    {
        $this->__content = $content;
    }

    /**
     * @param $template
     * @return void
     */
    public function setTemplate($template)
    {
        $this->__template = $template;
    }

    /**
     * @return string
     */
    public function template()
    {
        return $this->__template;
    }
}

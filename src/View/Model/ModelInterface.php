<?php

namespace Framework\View\Model;

interface ModelInterface
{
    /**
     * @return string
     */
    public function content();

    /**
     * @param $content
     * @return void
     */
    public function setContent($content);

    /**
     * @param $template
     * @return void
     */
    public function setTemplate($template);

    /**
     * @return string
     */
    public function template();
}

<?php

namespace Framework\View\Model;

interface ViewModel
{
    /**
     * @return string
     */
    function content();

    /**
     * @param $content
     * @return void
     */
    function setContent($content);

    /**
     * @param $template
     * @return void
     */
    function setTemplate($template);

    /**
     * @return string
     */
    function template();
}

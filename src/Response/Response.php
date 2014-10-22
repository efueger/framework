<?php

namespace Framework\Response;

interface Response
{
    /**
     * @return void
     */
    function send();

    /**
     * @param  mixed $content
     * @return void
     */
    function setContent($content);

    /**
     * @param int $status
     * @return void
     */
    function setStatus($status);
}

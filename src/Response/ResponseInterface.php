<?php

namespace Framework\Response;

interface ResponseInterface
{
    /**
     * @param  mixed $content
     * @return void
     */
    public function setContent($content);

    /**
     * @param int $status
     * @return void
     */
    public function setStatus($status);
}

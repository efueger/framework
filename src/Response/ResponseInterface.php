<?php

namespace Framework\Response;

interface ResponseInterface
{
    /**
     *
     */
    const STATUS_404 = 404;

    /**
     *
     */
    const STATUS_500 = 500;

    /**
     * @return mixed
     */
    public function content();

    /**
     * @return array|\Traversable
     */
    public function headers();

    /**
     * @return string
     */
    public function reason();

    /**
     * @return int
     */
    public function status();

    /**
     * @param  mixed $content
     * @return void
     */
    public function setContent($content);

    /**
     * @param $reason
     * @return void
     */
    public function setReason($reason);

    /**
     * @param int $code
     * @return void
     */
    public function setStatus($code);

    /**
     * @return int
     */
    public function version();

    /**
     * @param $version
     * @return void
     */
    public function setVersion($version);
}

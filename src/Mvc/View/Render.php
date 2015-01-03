<?php
/**
 *
 */

namespace Framework\Mvc\View;

use Framework\Response\Response;

interface Render
{
    /**
     * @param Response $response
     * @param $model
     * @return mixed
     */
    function __invoke(Response $response, $model = null);
}

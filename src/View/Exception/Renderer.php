<?php

namespace Framework\View\Exception;

use Exception;
use Framework\View\Manager\ManageView;

class Renderer
    implements Render
{
    /**
     *
     */
    use ManageView;

    /**
     * @param Exception $exception
     * @param ExceptionModel $model
     * @return mixed
     */
    public function __invoke(Exception $exception, ExceptionModel $model)
    {
        $model->setException($exception);
        return $this->render($model);
    }
}

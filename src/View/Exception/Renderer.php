<?php
/**
 *
 */

namespace Mvc5\View\Exception;

use Exception;
use Mvc5\View\Manager\ManageView;

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
        $model->exception($exception);

        return $this->render($model);
    }
}

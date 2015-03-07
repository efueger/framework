<?php
/**
 *
 */

namespace Mvc5\Mvc\View;

use Exception;
use Mvc5\Response\Response;
use Mvc5\View\Manager\ManageView;
use Mvc5\View\Model\ViewModel;

class Renderer
    implements Render
{
    /**
     *
     */
    use ManageView;

    /**
     * @param Response $response
     * @param $model
     * @return mixed
     */
    public function __invoke(Response $response, $model = null)
    {
        $model = $model ?: $response->content();

        if (!$model instanceof ViewModel) {
            return $model;
        }

        try {

            $response->setContent($this->render($model));

        } catch(Exception $exception) {

            $response->setContent($this->exception($exception));

        }

        return $response;
    }
}

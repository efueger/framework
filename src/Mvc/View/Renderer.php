<?php

namespace Framework\Mvc\View;

use Exception;
use Framework\Response\Response;
use Framework\View\Model\Plugin;
use Framework\View\Model\ViewModel;
use Framework\View\Manager\ManageView;

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

        $model instanceof Plugin
            && !$model->viewManager() && $model->setViewManager($this->viewManager());

        try {

            $response->setContent($this->render($model));

        } catch(Exception $exception) {

            $response->setContent($this->exception($exception));

        }
    }
}

<?php

namespace Framework\View\Renderer;

use Closure;
use Exception;
use Framework\View\Manager\ViewManager;
use Framework\View\Model\Plugin;
use Framework\View\Model\ViewModel;

trait RenderView
{
    /**
     * @param $template
     * @return string
     */
    protected abstract function template($template);

    /**
     * @return ViewManager
     */
    protected abstract function viewManager();

    /**
     * @param ViewModel $model
     * @return string
     */
    public function __invoke(ViewModel $model)
    {
        foreach($model->config() as $k => $v) {
            $v instanceof ViewModel && $model->set($k, $this($v));
        }

        if ($template = $this->template($model->path())) {
            $model->template($template);
        }

        $model instanceof Plugin
            && !$model->viewManager() && $model->setViewManager($this->viewManager());

        $render = Closure::bind(function() {
                /** @var ViewModel $this */

                extract((array) $this->config());

                ob_start();

                try {

                    include $this->path();

                    return ob_get_clean();

                } catch(Exception $exception) {

                    ob_get_clean();

                    throw $exception;
                }


            },
            $model
        );

        return $render();
    }
}

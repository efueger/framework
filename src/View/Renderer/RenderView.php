<?php

namespace Framework\View\Renderer;

use Closure;
use Exception;
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
     * @param ViewModel $model
     * @return string
     */
    public function __invoke(ViewModel $model)
    {
        foreach($model->config() as $k => $v) {
            if (!$v instanceof ViewModel) {
                continue;
            }

            $model instanceof Plugin && $model->viewManager()
                        && $v instanceof Plugin && !$v->viewManager() && $v->setViewManager($model->viewManager());

            $model->set($k, $this($v));
        }

        if ($template = $this->template($model->path())) {
            $model->template($template);
        }

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

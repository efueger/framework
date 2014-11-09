<?php

namespace Framework\View\Renderer;

use Closure;
use Exception;
use Framework\View\Model\ViewModel;

trait RenderView
{
    /**
     * @param ViewModel $model
     * @return string
     */
    public function __invoke(ViewModel $model)
    {
        foreach($model->config() as $k => $v) {
            if ($v instanceof ViewModel) {
                $model->set($k, $this($v));
            }
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

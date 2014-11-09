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
        foreach($model as $k => $v) {
            if ($v instanceof ViewModel) {
                $model->$k = $this($v);
            }
        }

        $render = Closure::bind(function() {
                /** @var ViewModel $this */

                extract((array) $this);

                ob_start();

                try {

                    include $this->template();

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

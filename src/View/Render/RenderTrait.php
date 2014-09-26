<?php

namespace Framework\View\Render;

use Closure;
use Exception;
use Framework\View\Model\ModelInterface as ViewModel;

trait RenderTrait
{
    /**
     * @param ViewModel $model
     * @return string
     */
    public function render(ViewModel $model)
    {
        foreach($model as $k => $v) {
            if ($v instanceof ViewModel) {
                $model->$k = $this->render($v);
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

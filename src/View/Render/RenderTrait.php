<?php

namespace Framework\View\Render;

use Closure;
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

                include $this->template();

                return ob_get_clean();
            },
            $model
        );

        return $render();
    }
}

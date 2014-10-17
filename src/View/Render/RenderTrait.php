<?php

namespace Framework\View\Render;

use Closure;
use Exception;
use Framework\View\Model\ModelInterface as ViewModel;

trait RenderTrait
{
    /**
     * @param ViewModel $viewModel
     * @param callable $plugins
     * @return string
     */
    public function __invoke(ViewModel $viewModel, callable $plugins = null)
    {
        foreach($viewModel as $k => $v) {
            if ($v instanceof ViewModel) {
                $viewModel->$k = $this($v);
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
            $viewModel
        );

        return $render();
    }
}

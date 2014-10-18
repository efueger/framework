<?php

namespace Framework\Mvc\Render;

use Exception;
use Framework\View\Model\ModelInterface as View;
use Framework\View\Manager\ServiceTrait as ViewManager;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use ViewManager;

    /**
     * @param View $viewModel
     * @param callable $plugin
     * @return mixed
     */
    public function __invoke(View $viewModel = null, callable $plugin = null)
    {
        if (!$viewModel) {
            return null;
        }

        try {

            return $this->render($viewModel, [], $plugin);

        } catch(Exception $exception) {

            return $this->exception($exception, $plugin);

        }
    }
}

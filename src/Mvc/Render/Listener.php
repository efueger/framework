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
     * @param callable $plugins
     * @return mixed
     */
    public function __invoke(View $viewModel = null, callable $plugins = null)
    {
        if (!$viewModel) {
            return null;
        }

        try {

            return $this->render($viewModel, [], $plugins);

        } catch(Exception $exception) {

            return $this->exception($exception, $plugins);

        }
    }
}

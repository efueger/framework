<?php

namespace Framework\View\Exception;

use Exception;
use Framework\View\Manager\ServiceTrait as ViewManager;
use Framework\View\Model\ServiceTrait as ViewModelTrait;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use ViewManager;
    use ViewModelTrait;

    /**
     * @param Exception $exception
     * @param callable $plugin
     * @return mixed
     */
    public function __invoke(Exception $exception, callable $plugin = null)
    {
        /** @var ViewModelInterface $viewModel */

        $viewModel = $this->viewModel();

        $viewModel->setException($exception);

        return $this->render($viewModel, [], $plugin);
    }
}

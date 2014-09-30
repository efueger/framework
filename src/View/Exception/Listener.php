<?php

namespace Framework\View\Exception;

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
     * @param EventInterface $event
     * @return mixed
     */
    public function __invoke(EventInterface $event)
    {
        /** @var ViewModelInterface $viewModel */

        $viewModel = $this->viewModel();

        $viewModel->setException($event->exception());

        return $this->render($viewModel);
    }
}

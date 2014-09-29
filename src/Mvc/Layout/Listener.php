<?php

namespace Framework\Mvc\Layout;

use Framework\Mvc\EventInterface;
use Framework\View\Model\ServiceTrait as ViewModelTrait;
use Framework\View\Layout\LayoutInterface as LayoutModel;
use Framework\View\Model\ModelInterface as ViewModel;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use ViewModelTrait;

    /**
     * @param EventInterface $event
     * @param array $options
     * @return ViewModel
     */
    public function __invoke(EventInterface $event, array $options = [])
    {
        $layout = $this->viewModel();
        $model  = $event->viewModel();

        if (!$model) {
            return null;
        }

        if ($model instanceof LayoutModel) {
            return $model;
        }

        $layout->setContent($model);

        return $layout;
    }
}

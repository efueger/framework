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
     * @param null $options
     * @return ViewModel
     */
    public function __invoke(EventInterface $event, $options = null)
    {
        $layout = $this->viewModel();
        $model  = $event->viewModel();

        if (!$model) {
            return $layout;
        }

        if ($model instanceof LayoutModel) {
            return $model;
        }

        $layout->setContent($model);

        return $layout;
    }
}

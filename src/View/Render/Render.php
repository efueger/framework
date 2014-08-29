<?php

namespace Framework\View\Render;

use Framework\View\Model\ModelInterface as ViewModel;

class Render
    implements RenderInterface
{
    /**
     *
     */
    use RenderTrait;

    /**
     * @param EventInterface $event
     * @param ViewModel $viewModel
     * @return mixed
     */
    public function __invoke(EventInterface $event, ViewModel $viewModel)
    {
        return $this->render($viewModel);
    }
}

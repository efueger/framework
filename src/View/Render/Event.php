<?php

namespace Framework\View\Render;

use Framework\Event\EventTrait as EventTrait;
use Framework\View\Model\ModelInterface as ViewModel;

class Event
    implements EventInterface
{
    /**
     *
     */
    use EventTrait;

    /**
     *
     */
    const EVENT = self::RENDER;

    /**
     * @var ViewModel
     */
    protected $viewModel;

    /**
     * @param ViewModel $viewModel
     */
    public function __construct(ViewModel $viewModel)
    {
        $this->viewModel = $viewModel;
    }

    /**
     * @return ViewModel
     */
    public function viewModel()
    {
        return $this->viewModel;
    }

    /**
     * @param callable $listener
     * @return mixed
     */
    public function __invoke(callable $listener)
    {
        return $listener($this, $this->viewModel);
    }
}

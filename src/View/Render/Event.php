<?php

namespace Framework\View\Render;

use Framework\Event\EventTrait;
use Framework\Event\Signal\SignalTrait;
use Framework\View\Model\ModelInterface as ViewModel;

class Event
    implements EventInterface
{
    /**
     *
     */
    use EventTrait;
    use SignalTrait;

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
     * @return array
     */
    protected function args()
    {
        return [
            ArgsInterface::EVENT     => $this,
            ArgsInterface::VIEWMODEL => $this->viewModel
        ];
    }

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    public function __invoke(callable $listener, array $args = [])
    {
        return $this->signal($listener, $this->args() + $args);
    }
}

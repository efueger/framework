<?php

namespace Framework\View\Model\Service;

use Framework\View\Model\ViewModel as Model;

trait ViewModel
{
    /**
     * @var Model
     */
    protected $viewModel;

    /**
     * @param Model $viewModel
     * @return self
     */
    public function setViewModel(Model $viewModel)
    {
        $this->viewModel = $viewModel;
    }

    /**
     * @return Model
     */
    public function viewModel()
    {
        return $this->viewModel;
    }
}

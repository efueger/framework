<?php

namespace Framework\View\Model;

use Framework\View\Model\ModelInterface as ViewModel;

trait ServiceTrait
{
    /**
     * @var ViewModel
     */
    protected $viewModel;

    /**
     * @param ViewModel $viewModel
     * @return self
     */
    public function setViewModel(ViewModel $viewModel)
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
}

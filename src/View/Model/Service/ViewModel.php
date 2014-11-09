<?php

namespace Framework\View\Model\Service;

use Framework\View\Model\ViewModel as Model;

trait ViewModel
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Model $model
     * @return self
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function model()
    {
        return $this->model;
    }
}

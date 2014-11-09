<?php

namespace Framework\View\Model\Service;

use Framework\View\Model\Model as Base;
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

    /**
     * @param string $template
     * @param array $vars
     * @return Model
     */
    public function view($template = null, array $vars = [])
    {
        if (!$this->model) {
            return new Base($template, $vars);
        }

        $template && $this->model->template($template);
        $vars     && $this->model->vars($vars);

        return $this->model;
    }
}

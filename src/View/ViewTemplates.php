<?php

namespace Framework\View;

trait ViewTemplates
{
    /**
     * @var array
     */
    protected $templates = [];

    /**
     * @param string $template
     * @return string
     */
    public function template($template)
    {
        return isset($this->templates[$template]) ? $this->templates[$template] : null;
    }

    /**
     * @param array $templates
     */
    public function templates(array $templates)
    {
        $this->templates = $templates;
    }
}

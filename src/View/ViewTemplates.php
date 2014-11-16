<?php

namespace Framework\View;

use Framework\Config\Configuration;

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
     * @param array|Configuration $templates
     */
    public function templates($templates)
    {
        $this->templates = $templates;
    }
}

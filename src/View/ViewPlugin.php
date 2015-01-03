<?php
/**
 *
 */

namespace Framework\View;

use Framework\View\Manager\ManageView;

trait ViewPlugin
{
    /**
     *
     */
    use ManageView;

    /**
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call($name, array $args = [])
    {
        return $this->call($name, $args);
    }
}

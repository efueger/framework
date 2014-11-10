<?php

namespace Framework\View\Renderer;

use Framework\View\Manager\ManageView;
use Framework\View\ViewTemplates;

class Renderer
    implements ViewRenderer
{
    /**
     *
     */
    use ManageView;
    use RenderView;
    use ViewTemplates;
}

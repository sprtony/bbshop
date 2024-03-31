<?php

namespace BlackBox\Admin\Actions;

use SolutionForest\FilamentTree\Actions\ViewAction;

class TreeViewAction extends ViewAction
{
    public function isModalHidden()
    {
        return $this->isModalHidden;
    }
}

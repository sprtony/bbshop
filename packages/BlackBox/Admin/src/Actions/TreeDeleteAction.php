<?php

namespace BlackBox\Admin\Actions;

use SolutionForest\FilamentTree\Actions\DeleteAction;

class TreeDeleteAction extends DeleteAction
{
    public function isModalHidden()
    {
        return $this->isModalHidden;
    }
}

<?php

namespace BlackBox\Admin\Actions;

use SolutionForest\FilamentTree\Actions\EditAction;

class TreeEditAction extends EditAction
{
    public function isModalHidden()
    {
        return $this->isModalHidden;
    }
}

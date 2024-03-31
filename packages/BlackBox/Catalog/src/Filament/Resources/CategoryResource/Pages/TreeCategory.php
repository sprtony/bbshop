<?php

namespace BlackBox\Catalog\Filament\Resources\CategoryResource\Pages;

use BlackBox\Admin\Actions;
use BlackBox\Catalog\Filament\Resources\CategoryResource;
use SolutionForest\FilamentTree\Resources\Pages\TreePage as BasePage;

class TreeCategory extends BasePage
{
    protected static string $resource = CategoryResource::class;

    protected static int $maxDepth = 2;

    protected function getActions(): array
    {
        return [
            $this->getCreateAction(),
        ];
    }

    protected function getTreeActions(): array
    {
        return [
            // Actions\Action::make('edit')
            //     ->url(fn (Category $category) => CategoryResource::getUrl('edit', ['record' => $category]))
            //     ->icon('heroicon-m-pencil-square')
            //     ->iconButton(),
            Actions\TreeViewAction::make(),
            Actions\TreeEditAction::make(),
            Actions\TreeDeleteAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }

    public function getTreeRecordIcon(?\Illuminate\Database\Eloquent\Model $record = null): ?string
    {
        return null;
    }
}

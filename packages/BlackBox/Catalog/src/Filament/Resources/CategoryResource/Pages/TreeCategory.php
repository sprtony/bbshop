<?php

namespace Quimaira\Catalog\Filament\Resources\CategoryResource\Pages;

use Filament\Pages\Actions\CreateAction;
use SolutionForest\FilamentTree\Actions;
use SolutionForest\FilamentTree\Concern;
use SolutionForest\FilamentTree\Resources\Pages\TreePage as BasePage;
use SolutionForest\FilamentTree\Support\Utils;


use Quimaira\Catalog\Filament\Resources\CategoryResource;
use Quimaira\Catalog\Models\Category;

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
            Actions\Action::make('edit')
                ->url(fn (Category $category) => CategoryResource::getUrl('edit', ['record' => $category]))
                ->icon('heroicon-m-pencil-square')
                ->iconButton(),
            Actions\DeleteAction::make(),
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

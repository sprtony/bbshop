<?php

namespace BlackBox\Catalog\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\Attributes\Url;
use BlackBox\Catalog\Models\{Category, Brand, Product};

class Listado extends Component
{
    public ?Category $category = null;
    public Collection $categories, $brands;
    public int $perPage = 24;
    public int $page = 0;
    public array $loadedProducts = [];

    #[Url(as: 'marcas')]
    public array $selectedBrands = [];

    // attributes
    #[Url(as: 'promocion')]
    public bool $promotion = false;

    public function mount($category)
    {
        $this->category = $category;
        // load data for filters
        $this->categories = Category::firstLevel()->with('children')->orderBy('order', 'asc')->get();
        $this->brands = Brand::where('active', 1)->get();
    }

    public function loadMore()
    {
        $this->page++;
    }

    public function render()
    {
        $nextProducts = Product::where('active', 1)
            // categories filter
            ->when($this->category, function ($query) {
                return $query->whereHas('categories', fn ($query) => $query->where('id', $this->category->id));
            })
            // brands filter
            ->when(count($this->selectedBrands), function ($query) {
                return $query->whereHas('brand', fn ($query) => $query->whereIn('slug', $this->selectedBrands));
            })
            // attributes filter
            ->when($this->promotion, fn ($query) => $query->where('promotion', 1))

            // cursor
            ->offset($this->perPage * $this->page)->limit($this->perPage)
            ->get();

        // merge list
        $this->loadedProducts = ($this->page == 0) ? $nextProducts->toArray() :
            [...$this->loadedProducts, ...$nextProducts->toArray()];

        return view('catalog::livewire.listado', ['products' => $this->loadedProducts]);
    }

    public function toggleSelectedBrands($value)
    {
        if (is_numeric($key = array_search($value, $this->selectedBrands))) {
            unset($this->selectedBrands[$key]);
            return;
        }
        $this->selectedBrands[] = $value;
    }


    public function togglePromotion()
    {
        $this->promotion = !$this->promotion;
    }
}

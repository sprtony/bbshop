<?php

namespace Quimaira\Catalog\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\Attributes\Url;
use Quimaira\Catalog\Models\{Category, Brand, Product};

class Listado extends Component
{
    public ?Category $category = null;
    public Collection $categories, $brands;
    public int $perPage = 24;

    #[Url(as: 'promocion')]
    public bool $promotion = false;

    #[Url(as: 'marcas')]
    public array $selectedBrands = [];

    public function mount($category)
    {
        $this->category = $category;
        $this->brands = Brand::where('active', 1)->get();
        $this->categories = Category::firstLevel()->with('children')->orderBy('order', 'asc')->get();
    }

    public function togglePromotion()
    {
        $this->promotion = !$this->promotion;
    }

    public function toggleSelectedBrands($value)
    {
        if (is_numeric($key = array_search($value, $this->selectedBrands))) {
            unset($this->selectedBrands[$key]);
            return;
        }
        $this->selectedBrands[] = $value;
    }

    public function loadMore()
    {
        $this->perPage += $this->perPage;
    }

    public function render()
    {
        if ($this->category) {
            $catagory = Category::with('products')->whereHas('products', function ($query) {
                return $query->where('active', 1)
                    ->when($this->promotion, function ($query) {
                        return $query->where('promotion', 1);
                    })
                    ->when(count($this->selectedBrands), function ($query) {
                        return $query->whereHas('brand', function ($query) {
                            return $query->whereIn('slug', $this->selectedBrands);
                        });
                    });
            })->find($this->category->id);
            $products = $catagory->products ?? [];
            $products = new LengthAwarePaginator($products, count($products), $this->perPage);
        } else {
            $products = Product::where('active', 1)
                ->when($this->promotion, function ($query) {
                    return $query->where('promotion', 1);
                })
                ->when(count($this->selectedBrands), function ($query) {
                    return $query->whereHas('brand', function ($query) {
                        return $query->whereIn('slug', $this->selectedBrands);
                    });
                })
                ->paginate($this->perPage);
        }

        return view('catalog::livewire.listado', compact('products'));
    }
}

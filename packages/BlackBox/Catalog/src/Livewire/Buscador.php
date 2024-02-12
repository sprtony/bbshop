<?php

namespace Quimaira\Catalog\Livewire;

use Livewire\Component;
use Quimaira\Catalog\Models\Product;

class Buscador extends Component
{
    public string $search = "";
    public bool $open = false;

    public function updatedSearch()
    {
        $this->open = true;
        if ($this->search == "") {
            $this->open = false;
        }
    }

    public function render()
    {
        $results = [];
        if ($this->search != "") {
            $results = Product::where('active', 1)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('capacity', 'like', '%' . $this->search . '%');
                })
                ->limit(5)
                ->get();
        }

        return view('catalog::livewire.buscador', compact('results'));
    }
}

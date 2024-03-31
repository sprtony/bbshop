<?php

namespace Quimaira\Blog\Livewire;

use Livewire\Component;
use Quimaira\Blog\Models\BlogCategory;
use Quimaira\Blog\Models\BlogPost;

class Listado extends Component
{
    public ?BlogCategory $category = null;

    public int $perPage = 16;

    public function mount($category)
    {
        $this->category = $category;
    }

    public function loadMore()
    {
        $this->perPage += $this->perPage;
    }

    public function render()
    {
        if ($this->category) {
            $posts = $this->category->posts()->where('active', 1)->get();
        } else {
            $posts = BlogPost::where('active', 1)
                ->paginate($this->perPage);
        }

        return view('blog::livewire.listado', compact('posts'));
    }
}

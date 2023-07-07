<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductsTable extends Component
{
    public $products;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $products,
        public bool $isSearch = false,
        public string $sortOrder,
        public string $query
    ) {
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.products-table');
    }
}
<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteProduct extends Component
{
    public string $url;
    public string $name;

    public function __construct(string $url, string $name = 'Product')
    {
        $this->url = $url;
        $this->name = $name;
    }

    public function render(): View|Closure|string
    {
        return view('components.delete-product');
    }
}
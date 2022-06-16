<?php

namespace App\Http\Livewire;

use App\Liga;
use App\Product;
use App\Categories;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home', [
            'products' => Product::take(4)->get(),
            'categories' => Categories::all()
        ]);
    }
}

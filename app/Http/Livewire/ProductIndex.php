<?php

namespace App\Http\Livewire;

use App\Pesanan;
use App\PesananDetail;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
// use Livewire\WithPagination;

class ProductIndex extends Component
{
    // use WithPagination;

    public $search;

    // protected $updateQueryString = ['search'];

    public function mount() {
        $this->search = '';
    }

    // public function updatingSearch($value)
    // {
    //     $this->refresh;
    // }

    public function render()
    {

        if ($this->search) {
            $products = Product::where('nama', 'like', '%' . $this->search . '%')->paginate(12);
        } else {
            $products = Product::paginate(12);
        }

        return view('livewire.product-index', [
            'products' => $products,
            'search' => $this->search
        ]);
    }
}

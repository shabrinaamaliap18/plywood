<?php

namespace App\Http\Livewire;

use App\Categories;
use App\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCategories extends Component
{
    use WithPagination;

    public $search, $categories;

    protected $updateQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount($categoriId)
    {
        $categoriDetail = Categories::find($categoriId);

        if($categoriDetail) {
            $this->categories = $categoriDetail;
        }
    }

    public function render()
    {
        if($this->search) {
            $products = Product::where('id_kategori', $this->categories->id)->where('nama', 'like', '%'.$this->search.'%')->paginate(8);
        }else {
            $products = Product::where('id_kategori', $this->categories->id)->paginate(8);
        }
        
        return view('livewire.product-index', [
            'products' => $products,
            'title' => 'Produk '.$this->categories->nama
        ]);
    }
}

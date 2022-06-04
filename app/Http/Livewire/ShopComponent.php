<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\WithPagination;
use Livewire\Component;
use Cart;
use App\Models\Category;
class ShopComponent extends Component
{
    use WithPagination;
    public $pageSize;
    public $sorting;
    public function mount(){
        $this->pageSize = 12;
        $this->sorting = 'default';
    }
    public function test(){
        dd('test');
    }

    public function store($product_id,$product_name,$product_price){
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        toastr()->success('product added succesfuly');
        return redirect()->route('product.cart');
    }

    public function render()
    {
        if($this->sorting == 'date'){
            $products = Product::orderBy('created_at','DESC')->paginate($this->pageSize);
        }
        else if ($this->sorting == 'price'){
            $products = Product::orderBy('regular_price','ASC')->paginate($this->pageSize);
        }
        else if ($this->sorting == 'price-desc'){
            $products = Product::orderBy('regular_price','DESC')->paginate($this->pageSize);
        }
        else {
            $products = Product::paginate($this->pageSize);
        }
        $categories = Category::all();

        return view('livewire.shop-component',['products'=>$products,'categories'=>$categories])->layout('layouts.base');
    }


}

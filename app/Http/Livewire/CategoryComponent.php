<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\WithPagination;
use Livewire\Component;
use Cart;
use App\Models\Category;
class CategoryComponent extends Component
{
    use WithPagination;
    public $pageSize;
    public $sorting;
    public $category_slug;

    public function mount($category_slug){
        $this->pageSize = 12;
        $this->sorting = 'default';
        $this->category_slug = $category_slug;
    }

    public function test(){
        dd('');
    }

    public function render()
    {
        $categories = Category::where('slug',$this->category_slug)->first();
        $category_id = $categories->id;
        $category_name = $categories->name;
        if($this->sorting == 'date'){
            $products = Product::where('category_id',$category_id)->orderBy('created_at','DESC')->paginate($this->pageSize);
        }
        else if ($this->sorting == 'price'){
            $products = Product::where('category_id',$category_id)->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }
        else if ($this->sorting == 'price-desc'){
            $products = Product::where('category_id',$category_id)->orderBy('regular_price','DESC')->paginate($this->pageSize);
        }
        else {
            $products = Product::where('category_id',$category_id)->paginate($this->pageSize);
        }
        $categories = Category::all();

        return view('livewire.category-component',['products'=>$products,'categories'=>$categories,'category_name'=>$category_name])->layout('layouts.base');
    }

    public function store($product_id,$product_name,$product_price){
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        toastr()->success('product added succesfuly');
        return redirect()->route('product.cart');
    }
}

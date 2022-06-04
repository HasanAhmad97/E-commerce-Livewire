<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\withFileUploads;

class ProductComponent extends Component
{
    use withFileUploads;
    public $name,$slug,$regular_price,$sale_price,$stock_status,$SKU,$image,$category_id,$featured,$quantity;
    public $description,$short_description,$updateMode,$product_id;

    public function generateSlug(){
        $this->slug = \Illuminate\Support\Str::slug($this->name);
    }

    public function storeProduct(){
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->featured = intval($this->featured);
        $product->stock_status = $this->stock_status;
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('products',$imageName);
        $product->category_id = $this->category_id;
        $product->quantity = $this->quantity;
        $product->SKU = $this->SKU;
        $product->description = $this->description;
        $product->short_description = $this->short_description;
        $product->image = $imageName;
//        dd($product);
        $product->save();
        session()->flash('message','Product Created Successfully');
        return redirect()->route('admin.products');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $product = Product::where('id',$id)->first();
        $this->product_id = $id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->featured = $product->featured;
        $this->stock_status = $product->stock_status;
        $this->SKU = $product->SKU;
        $this->quantity = $product->quantity;
        $this->image = $product->image;
        $this->category_id = $product->category_id;



    }

    public function render()
    {
        $products = Product::paginate(5);
        $categories = Category::all();
        return view('livewire.admin.product-component',['products'=>$products,'categories'=>$categories])->layout('layouts.dashboard.app');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Cart;
class CartComponent extends Component
{
    public function increaseQty($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty+1;
        Cart::update($rowId,$qty);
    }
    public function decreaseQty($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty-1;
        Cart::update($rowId,$qty);
    }

    public function destroy($rowId){
        Cart::remove($rowId);
        toastr()->error('deleted successfuly');
    }
    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}

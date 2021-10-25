<?php

namespace App\Repositories;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;

class CartRepository 
{
    public function _add($data)
    {
        return Product::create($data);
    }
    public function _edit($id)
    {
        return Product::find($id);
    }
    public function _update($id, $data)
    {
        $cms = Product::find($id);
        $cms->title = $data['title'];
        $cms->details = $data['details'];
        $cms->image = $data['image'];
        $cms->price = $data['price'];
        $cms->quantity = $data['quantity'];
        $cms->save();
        return true;
    }
    public function _delete($id)
    {
        return Product::find($id)->delete();
    }
    
    public function _getProducts(){
        return Product::select('*')->get();
        
    }
   
}

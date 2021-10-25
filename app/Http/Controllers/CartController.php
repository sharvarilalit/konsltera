<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cartList()
    {
        $cartItems = Cart::selectRaw('*, sum(quantity) as quantity')->with('products')
            ->where('userId', '=', Auth::user()->id)
            ->where('quantity', '>', 0)
            ->groupBy('productId', 'userId')
            ->get()->toArray();
        return view('user.cart.cart', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {

        $res = Cart::select('quantity')->where('userId', Auth::user()->id)->where('productId', $request->pid)->get()->toArray();
        if (!empty($res)) {
            Cart::where('userId', Auth::user()->id)->where('productId', $request->pid)->update(array('quantity' => $res[0]['quantity'] + $request->quantity));
        } else {
            Cart::create([
                'productId' => $request->pid,
                'userId' => Auth::user()->id,
                'quantity' => $request->quantity
            ]);
        }
        $product = Product::find($request->pid);
        $product->quantity = $product->quantity - $request->quantity;
        $product->save();

        return $this->Result('Product is Added to Cart Successfully !');

    }

    public function updateCart(Request $request)
    {
        //dd($request->id);
       // $precartvalue = Cart::select('productId', 'quantity')->where('id', $request->id)->get()->toArray();

        $precartvalue = $request->prevcartquantity;
        $cart = Cart::find($request->id);
        $cart->quantity = $request->quantity;
        $cart->save();


        $product = Product::find($request->productId);

        if($request->quantity < $precartvalue){
           $product->quantity = $product->quantity + ($precartvalue -$request->quantity);
        }
        else{
            $product->quantity = $product->quantity - ($request->quantity-$precartvalue);
        }
        $product->save();
        return  $this->Result('Item Cart is Updated Successfully !');

    }

    public function removeCart(Request $request)
    {
        $res = Cart::select('quantity', 'productId')->where('id', '=', $request->id)->get()->toArray();
        Cart::where('id', $request->id)->delete();
        $product = Product::find($res[0]['productId']);
        $product->quantity = $product->quantity + $res[0]['quantity'];
        $product->save();

        return $this->Result('Item  Removed Successfully !');

    }

    public function clearAllCart()
    {
        Cart::clear();
        return $this->Result('All Item Cart Clear Successfully !');
    }

    public function Result($message)
    {
        session()->flash('success', $message);
        return redirect()->route('cart.list');
    }
}

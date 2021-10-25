<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $products;
    public function __construct(ProductRepository $product)
    {
        $this->products = $product;
        $this->middleware('auth');
    }

    public function index()
    {
        $allcolors = $this->products->_getProducts();

        // dd($allcolors);
        // exit();
        return view('admin.products.list', compact('allcolors'));
    }
    public function add($id = null)
    {
        if (is_null($id)) {
            return view('admin.products.add');
        } else {
            $getColorbyId = $this->products->_edit($id);
            return view('admin.products.add', compact('getColorbyId'));
        }
    }
    public function save(Request $request)
    {
        
      // dd($request->file('image'));

        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            //'image' => 'required',
            //'image.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf'
        ]);
     
        $name="";
        if($request->hasFile('image')){
            $name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/uploads/', $name);  
            //dd($name);exit();
        }

       // dd($name);
       
        
        $input_array = array(
            'title' => $request->title,
            'details' => $request->details,
            'price' => $request->price,
            'quantity' => $request->quantity ,
            'image' => $request->file('image')? $name: $request->prevfile 
        );

        if ($request->id == 0) {
            $this->products->_add($input_array);
            return redirect('admin/product')->with('success', 'Product has been created successfully');
        } else {
            $this->products->_update($request->id, $input_array);
            return redirect('admin/product')->with('success', 'Product has been updated successfully');
        }
    }
    public function delete($id)
    {
        $this->products->_delete($id);
        return redirect('admin/product')->with('success', 'Product has been deleted successfully');
    }


    //user View
    public function display()
    {
        $products = Product::where('quantity', '>', 0)->get();
        $cartItems = Cart::where('quantity', '>', 0)->where('userId',Auth::user()->id)->count();
        return view('user.products.list', compact('products','cartItems'));
    }
}

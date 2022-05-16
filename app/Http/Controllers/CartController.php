<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class CartController extends Controller
{
    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);

        $cart = session()->get('cart', []);
  
        if(isset($cart[$product_id])) {
            $cart[$product_id]['quantity']++;
        } else {
            $cart[$product_id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back();
    }
    public function cart()
    {
        return view('cart');
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
                return response('success', 204);
            }
        }
    }
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return response('success', 204);
        }
    }
}

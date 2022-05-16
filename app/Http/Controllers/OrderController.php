<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
class OrderController extends Controller
{
    public function checkout()
    {
        if(session('cart') && count(session()->get('cart'))>0){
            $cart = session()->get('cart');
            $id = Auth::id();
            DB::table('orders')->insert([
                'user_id' => $id,
                'datas' => json_encode($cart),
                'created_at' => now()
            ]);
            session()->put('cart', []);
            return view('checkout', ['message'=> 'Checkout Succesful!']);
        }
        return view('checkout', ['message'=> 'Checkout Failed!']);
    }
    public function orders(){
        return view('orders', [
            'orders' => Order::all()->sortByDesc('id')
        ]);
    }
    public function delete(Request $request){
        if($request->id){
            DB::table('orders')->where('id',$request->id)->update(array(
                'isDeleted'=>1,
                'updated_at'=>now()
            ));
            return response('success', 204);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function show()
    {
        return view('dashboard', [
            'products' => Product::where('available', '=', '1')->get()
        ]);
    }
    public function search(Request $request){
        $text = $request->input('search');
        return view('dashboard', [
            'products' => Product::where('available', '=', '1')->where(function($query) use ($text) {
                $query->where('name','LIKE','%'.$text.'%')
                ->orWhere('description','LIKE','%'.$text.'%');
            })->get()
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Models\Cart;
use Auth;

class welcome extends Controller
{   
    public function index(){

        
        $products = Products::leftJoin('product__categories','products.id', '=', 'product__categories.productId')->leftJoin('categories','product__categories.productId', '=', 'categories.id')->select('products.id AS id', 'products.productPathImage AS productPathImage','products.productName AS productName' , 'products.productPrice AS productPrice', 'products.productShortDescription AS productShortDescription')->selectRaw('GROUP_CONCAT(categories.categoryName) AS categoryName')->groupBy('products.id')->get();
        $categories = Category::all();
        if (Auth::user()){
            $cart = Products::join('carts', 'carts.productId', '=', 'products.id')->where('carts.userId', Auth::user()->id)->get(['carts.dateBuy as dateBuy', 'carts.dateNotBuy as dateNotBuy','products.id as id', 'products.productName as productName', 'products.productShortDescription as productShortDescription', 'products.productDescription as productDescription', 'products.productPathImage as productPathImage', 'products.productPrice as productPrice']);
            $countCart = count($cart);
        }else{
            $cart = [];
            $countCart = 0;
        }
        return view('welcome', array('products' => $products, 'categories' => $categories, 'cart' => $cart, 'countCart' => $countCart));

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;

class welcome extends Controller
{   
    public function index(){

        
        $products = Products::leftJoin('product__categories','products.id', '=', 'product__categories.productId')->leftJoin('categories','product__categories.productId', '=', 'categories.id')->select('products.id AS id', 'products.productPathImage AS productPathImage','products.productName AS productName' , 'products.productPrice AS productPrice', 'products.productShortDescription AS productShortDescription')->selectRaw('GROUP_CONCAT(categories.categoryName) AS categoryName')->groupBy('products.id')->get();
        //$products = Products::all();
        $categories = Category::all();
        return view('welcome', array('products' => $products, 'categories' => $categories, 'prueba' => 'hola crack'));
    }
}

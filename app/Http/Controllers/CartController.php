<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Models\Product_Category;
use App\Models\Cart;
use App\Models\Shopping_History;
use Auth;


class CartController extends Controller
{
    public function cartTobuy(){
        if (Auth::user()){
            $cart = Products::join('carts', 'carts.productId', '=', 'products.id')->where('carts.userId', Auth::user()->id)->get(['carts.id as cartId','carts.dateBuy as dateBuy', 'carts.dateNotBuy as dateNotBuy','products.id as id', 'products.productName as productName', 'products.productShortDescription as productShortDescription', 'products.productDescription as productDescription', 'products.productPathImage as productPathImage', 'products.productPrice as productPrice']);
            $countCart = count($cart);
        }else{
            $cart = [];
            $countCart = 0;
        }

        return view('Cart.CartToBuy', array('cart' => $cart, 'countCart' => $countCart));
    }

    public function buy(){
        
        $cart = Products::join('carts', 'carts.productId', '=', 'products.id')->where('carts.dateNotBuy','=','1900-01-01 12:12:12')->where('carts.userId', Auth::user()->id)->get(['carts.id as cartId', 'carts.dateBuy as dateBuy', 'products.id as id',  'products.productPrice as productPrice']);
        
        foreach ($cart as $key => $item){
   		    if($item->dateBuy == '1900-01-01 12:12:12'){
                $cartItem = Cart::find($item->cartId);
                $cartItem->dateBuy = Now();
                $cartItem->save();
            }
   		}
	
        
        return redirect('toBuy');
    }

    public function deleteCartItem($id = NULL){
        
        $cartItem = Cart::where('carts.dateNotBuy','=', '1900-01-01 12:12:12')->where('carts.dateBuy','=', '1900-01-01 12:12:12')->where('carts.id','=', $id)->get();
        if($cartItem){
            $cartItem = Cart::find($id);
            $cartItem->dateNotBuy = Now();
            $cartItem->save();
        }
        return redirect('toBuy');
    }
}

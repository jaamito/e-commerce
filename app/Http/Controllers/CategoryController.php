<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Models\Product_Category;
use Auth;

class CategoryController extends Controller
{

    public function createCategory(Request $request){
        $categories = Category::all();

        if (Auth::user()){
            $cart = Products::join('carts', 'carts.productId', '=', 'products.id')->where('carts.userId', Auth::user()->id)->get(['carts.dateBuy as dateBuy', 'carts.dateNotBuy as dateNotBuy','products.id as id', 'products.productName as productName', 'products.productShortDescription as productShortDescription', 'products.productDescription as productDescription', 'products.productPathImage as productPathImage', 'products.productPrice as productPrice']);
            $countCart = count($cart);
        }else{
            $cart = [];
            $countCart = 0;
        }

        return view('Category.category', array('categories' => $categories, 'cart' => $cart, 'countCart' => $countCart));
    }

    public function saveCategory(Request $request){
        if ($request->hasFile('categoryImage')) {

            // Get just Extension
            $extension = $request->file('categoryImage')->getClientOriginalExtension();
            // Filename To store
            $path_image = time().'.'.$extension;
            // Upload Image 
            echo $request->file('categoryImage')->storePubliclyAs('/public/category', $path_image);
            
        }else{
            $path_image = 'noimage.jpg';
        }

        $category = new Category();
        $category->categoryName = $request->input('categoryName');
        $category->categoryPathImage = $path_image;
        $category->save();
        return redirect('createCategory');
    }

    public function removeCategory(Request $request){

        $arrayDelCategories = request()->input('category');

        foreach ($arrayDelCategories as $key => $category){
            $category = Category::where('id', $category);
            $category->delete();
        }

        return redirect('createCategory');
    }

    public function categoryInfo($id = NULL){

        $category = Category::firstWhere('id', $id);
        $products = Products::join('product__categories', 'product__Categories.categoryId', '=', 'products.id')->where('product__categories.categoryId', $category->id)->get(['products.id as id', 'products.productName as productName', 'products.productShortDescription as productShortDescription', 'products.productDescription as productDescription', 'products.productPathImage as productPathImage', 'products.productPrice as productPrice']);
        
        if (Auth::user()){
            $cart = Products::join('carts', 'carts.productId', '=', 'products.id')->where('carts.userId', Auth::user()->id)->get(['carts.dateBuy as dateBuy', 'carts.dateNotBuy as dateNotBuy','products.id as id', 'products.productName as productName', 'products.productShortDescription as productShortDescription', 'products.productDescription as productDescription', 'products.productPathImage as productPathImage', 'products.productPrice as productPrice']);
            $countCart = count($cart);
        }else{
            $cart = [];
            $countCart = 0;
        }

        return view('Category.categoryInfo', array('products' => $products, 'category' => $category, 'cart' => $cart, 'countCart' => $countCart));
    }
}

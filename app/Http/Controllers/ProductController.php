<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Products;
use App\Models\Category;
use App\Models\Product_Category;
use App\Models\Cart;
use Auth;

class ProductController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('home');
    }

    public function createProduct(Request $request){
        $categories = Category::all();

        if (Auth::user()){
            $cart = Products::join('carts', 'carts.productId', '=', 'products.id')->where('carts.userId', Auth::user()->id)->get(['carts.dateBuy as dateBuy', 'carts.dateNotBuy as dateNotBuy','products.id as id', 'products.productName as productName', 'products.productShortDescription as productShortDescription', 'products.productDescription as productDescription', 'products.productPathImage as productPathImage', 'products.productPrice as productPrice']);
            $countCart = count($cart);
        }else{
            $cart = [];
            $countCart = 0;
        }
        
        return view('Products.product', array('categories' => $categories, 'cart' => $cart, 'countCart' => $countCart));
    }

    public function saveProduct(Request $request){
        
        //asset('storage/products/product_id.jpg')

        if ($request->hasFile('productImage')) {

            // Get just Extension
            $extension = $request->file('productImage')->getClientOriginalExtension();
            // Filename To store
            $path_image = time().'.'.$extension;
            // Upload Image 
            echo $request->file('productImage')->storePubliclyAs('/public/product', $path_image);
            
        }else{
            $path_image = 'noimage.jpg';
        }

            $product = new Products();
            $product->productName = $request->input('productName');
            $product->productShortDescription = $request->input('productShortDescription');
            $product->productDescription = $request->input('productDescription');
            $product->productPrice = $request->input('productPrice');
            $product->productPathImage = $path_image;
            $product->save();
            

            $lastProduct = Products::latest()->first();
            
            $arrayDelCategories = request()->input('category');
            if($arrayDelCategories){
                foreach ($arrayDelCategories as $key => $category){
                    
                    $product_category = new Product_Category();
                    $product_category->categoryId = $category;
                    $product_category->productId = $lastProduct->id;
                    $product_category->save();
                }
            }
            return redirect('/');
    
    }   

    public function productInfo($id = NULL){

        if($id != NULL){
            $product    = Products::firstWhere('id', $id);
            $categories = Category::join('product__categories', 'product__Categories.categoryId', '=', 'categories.id')->where('product__categories.productId', $product->id)->get(['categories.categoryName as categoryName', 'categories.id as id']);
            
            if (Auth::user()){
                $cart = Products::join('carts', 'carts.productId', '=', 'products.id')->where('carts.userId', Auth::user()->id)->get(['carts.dateBuy as dateBuy', 'carts.dateNotBuy as dateNotBuy','products.id as id', 'products.productName as productName', 'products.productShortDescription as productShortDescription', 'products.productDescription as productDescription', 'products.productPathImage as productPathImage', 'products.productPrice as productPrice']);
                $countCart = count($cart);
            }else{
                $cart = [];
                $countCart = 0;
            }

            if($product){
                $err = 0;
            }else{
                $err = 1;
            }
            
            return view('Products.productInfo', array('product' => $product, 'err' => $err, 'categories' => $categories, 'cart' => $cart, 'countCart' => $countCart));
        }

    }

    public function addToCartProduct($id = NULL){

        if($id){
            $cart = new Cart();
            $cart->productId = $id;
            $cart->productQta = 1;
            $cart->userId = Auth::user()->id;
            $cart->save();
        }   

        return redirect()->back(); 
    }

    
}

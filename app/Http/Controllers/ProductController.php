<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Products;
use App\Models\Category;
use App\Models\Product_Category;

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
        return view('Products.product', array('categories' => $categories));
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
            
            foreach ($arrayDelCategories as $key => $category){
                
                $product_category = new Product_Category();
                $product_category->categoryId = $category;
                $product_category->productId = $lastProduct->id;
                $product_category->save();
            }

            return redirect('/');
    
    }  

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function createCategory(Request $request){
        $categories = Category::all();
        return view('Category.category', array('categories' => $categories));
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
        return redirect('/createCategory');
    }

    public function removeCategory(Request $request){

        $arrayDelCategories = request()->input('category');

        foreach ($arrayDelCategories as $key => $category){
            $category = Category::where('id', $category);
            $category->delete();
        }

        return redirect('createCategory');
    }
}

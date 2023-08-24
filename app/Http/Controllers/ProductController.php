<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\NewProductRequest;
use App\Http\Requests\NewCategoryRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function allProduct (Request $request) 
    {  
        $products = Product::where('id', '>', 0)->paginate(4);
        $images = Image::all();

        return view('product.all_product',compact('products','images'));
    }

    public function newProduct(){

        return view('product.new_product');
    }

    public function createProduct(NewProductRequest $request)
    {

        Product::create($request->validated()+[
            'user_id' => auth()->id()
        ]);
        if($files = $request->file('images')){
            foreach ($files as $file){
                $image = Image::createImage($file);
                $product = Product::find(Product::max('id'));
                $product->images()->save($image);
            }
        }

        return redirect('/all_product')->with('success','product created successfully');
    }

    public function deleteProduct(Product $product, Image $image)
    {
        $names = Image::select('name')->where('imageable_id',$product->id)->get();
        foreach($names as $name){
            Storage::disk('public')->delete($name->name);
        }
        DB::table('images')->where('imageable_id',$product->id)->delete();
        $product->delete();

        return redirect('/all_product');
    }

    public function showEditProduct(Product $product, $id) 
    {
        $product = Product::find($id);
        $images = $product->images;

        return view('product.edit_product',compact('product','images')); 
    }

    public function saveEditProduct(Product $product, UpdateProductRequest $request) 
    {
        $product->update($request->validated());

        return redirect('/all_product');
    }

    public function allCategory (Request $request) 
    {  
        $categories = Category::all();

        // return view('product.all_category');
        return view('product.all_category',compact('categories'));

    }


    public function newCategory (Request $request) 
    {  
        $products = Product::all();

        // return view('product.all_category');
        return view('product.new_category',compact('products'));

    }

    public function showEditCategory(Category $category, $id) 
    {
        $category = Category::find($id);
        $products = Product::all();

        return view('product.edit_category',compact('products','category')); 
    }

    public function addNewCategory(NewCategoryRequest $request)
    {
        
        $category = Category::create($request->validated());
        $category->products()->attach($request->ids);

        return redirect('/all_category');
    }

    public function saveEditCategory(Category $category ,NewCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->validated());
        $category->products()->sync($request->ids);

        return redirect('/all_category');
    }

    public function deleteCategory(Category $category, Image $image)
    {
        $category->products()->detach();
        $category->delete();
        return redirect('/all_category'); 
    }
}

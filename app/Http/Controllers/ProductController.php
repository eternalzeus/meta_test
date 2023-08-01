<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\NewProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function allProduct (Request $request) {  
        $products = Product::where('id', '>', 0)->paginate(4);
        $images = Image::all();
        return view('product.all_product',compact('products','images'));
    }

    public function newProduct(){
        return view('product.new_product');
    }

    public function createProduct(NewProductRequest $request){

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

    public function deleteProduct(Product $product, Image $image){
        $names = Image::select('name')->where('imageable_id',$product->id)->get();
        foreach($names as $name){
            Storage::disk('public')->delete($name->name);
        }
        DB::table('images')->where('imageable_id',$product->id)->delete();
        $product->delete();
        return redirect('/all_product');
    }

    public function showEditProduct(Product $product, $Id) {
        $product = Product::find($Id);
        $images = $product->images;
        return view('product.edit_product',compact('product','images')); 
    }

    public function saveEditProduct(Product $product, UpdateProductRequest $request) {
        $product->update($request->validated());
        return redirect('/all_product');
    }
}

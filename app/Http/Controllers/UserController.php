<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    // Users new register
    public function register(RegisterRequest $request)
    {
        $user_info = $request->validated();
        $user_info['password'] = bcrypt($user_info['password']); 
        $user = User::create($user_info);
        auth()->login($user);

        return redirect('/home');
    }

    // Users log out
    public function logout()
    {
        auth()->logout();

        return redirect('/home');
    }
    
    // Users log in
    public function login(LoginRequest $request)
    {
        $user_info = $request->validated();
        if(auth()->attempt(['email'=>$user_info['loginemail'],'password'=>$user_info['loginpassword']])){
            $request->session()->regenerate(); // Generate a new session token
            return redirect('/home');
        }
        else{
            return back()->with ('error', 'Wrong Login Credentials');
        }
        
    }

    public function showRegister()
    {
        $categories = Category::all();

        return view('user.register_page', compact('categories'));
    }

    public function showLogin()
    {
        $categories = Category::all();
        
        return view('user.login_page', compact('categories'));
    }

    public function userHome(Request $request)
    {
        $products = Product::where('id', '>', 0)->paginate(4);
        $images = Image::all();
        $categories = Category::all();

        return view('user.user_home',compact('products', 'images', 'categories'));
    }

    public function productByCat($id)
    {
        $products = Product::whereHas('categories', function ($query) use ($id) {
            return $query->where('categories.id', '=', $id);
        })->paginate(4);
        $images = Image::all();
        $categories=Category::all();

        return view('user.user_home',compact('products', 'images', 'categories'));
    }

    public function productDetail($id)
    {
        $product = Product::find($id);
        $images = $product->images;
        $categories=Category::all();

        return view('user.product_detail',compact('product', 'images', 'categories'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    private function test(){
    }
    // Users new register
    public function register(RegisterRequest $request){
        $user_info = $request->validated();
        $user_info['password'] = bcrypt($user_info['password']); 
        $user = User::create($user_info);
        auth()->login($user);
        return redirect('/home');
    }

    // Users log out
    public function logout(){
        auth()->logout();
        return redirect('/home');
    }
    
    // Users log in
    public function login(LoginRequest $request){
        $user_info = $request->validated();
        if(auth()->attempt(['email'=>$user_info['loginemail'],'password'=>$user_info['loginpassword']])){
            $request->session()->regenerate(); // Generate a new session token
            return redirect('/home');
        }
        else{
            return back()->with ('error', 'Wrong Login Credentials');
        }
        
    }

    public function userHome(Request $request){
        $products = Product::where('id', '>', 0)->paginate(4);
        $images = Image::all();
        return view('user.user_home',compact('products', 'images'));
    }
}

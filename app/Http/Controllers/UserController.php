<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private function test(){
        dd(333);
    }
    // Users new register
    public function register(Request $request){
        $rules = [
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:200']
        ];

        $message = [
            'name.required'=>'User Name is required',
            'name.min'=>'User Name must has more than :min characters',
            'name.max'=>'User Name must has less than :max characters',
            'name.unique'=>'User Name has been taken',
            'email.required'=>'Email Address is required',
            'email.email'=>'Please enter a valid email',
            'email.unique'=>'The email has been registered before',
            'password.required'=>'Password is required',
            'password.min'=>'Password must has more than :min characters',
            'password.max'=>'Password must has less than :max characters'
        ];

        /* $message = [
            'required' => 'Trường :attribute cần được nhập'
        ]; */

        $incomingFields = $request->validate($rules, $message);
            
            // Nếu k validate dc thì sẽ redirect về request trước
    
        $incomingFields['password'] = bcrypt($incomingFields['password']); 
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/');
    }

    // Users log out
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
    
    // Users log in
    public function login(Request $request){
        $rules = [
            // 'loginname' => 'required',
            'loginemail' => 'required',
            'loginpassword' => 'required'
        ];
        $message = [
            'loginemail.required'=>'Email is required',
            'loginpassword' => 'Password is required'
        ];
        $incomingFields = $request->validate($rules, $message);
        if(auth()->attempt(['email'=>$incomingFields['loginemail'],'password'=>$incomingFields['loginpassword']])){
            $request->session()->regenerate(); // Generate a new session token
            return redirect('/');
        }
        else{
            return back()->with ('error', 'Wrong Login Credentials');
        }
        
    }

    // Home page
    public function home () {
        // dd(Session::all());
        $posts = [];
        if(auth()->check()){
            $user = auth() -> user();
            //dd($user);
            $userId = $user->id;
            //dd($userId);
            $data = Post::all(); // get() ~ SELECT, where() ~ WHERE in querry
            //dd($data);
            // $posts = auth()->user()->posts()->latest()->get();   // Sort all posts by date
        }
        // $posts = Post::where('user_id', auth()->id())->get(); 
        // dd($posts, $data);
        return view('home',['posts' => $data]);
    }
}

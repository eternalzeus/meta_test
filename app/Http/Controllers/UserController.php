<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private function test(){
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
        // $posts = [];
        if(auth()->check()){
            $posts = Post::all(); // get() ~ SELECT, where() ~ WHERE in querry
            $data = Post::join('comments', 'comments.post_id', '=', 'posts.id')
                ->join('users', 'comments.user_id', '=', 'users.id')
                ->select('posts.title as title', 'posts.body as content', 'comments.comment as comment', 'users.name as username', 'posts.id as post_id')
                ->get();
            $res = [];
            foreach($data as $value) {
                if (!empty($res[$value['post_id']] )) {
                    $res[$value['post_id']] = [
                        'title' => $value['title'],
                        'comment' => $res[$value['post_id']]['comment'] .'\n' . $value['username'] .': ' .$value['content'],
                        'content' => $value['content'],
                    ];
                } else {
                    $res[$value['post_id']] = [
                        'title' => $value['title'],
                        'content' => $value['username'] .': ' .$value['content'],
                        'comment' => $value['title'],
                    ];
                }
                
            }
            // dd($res);
            // dd($data->toArray());

            // $comments = Comment::all();
            // $users = User::all();
            // $images = Image::all();
            // $posts = auth()->user()->posts()->latest()->get();   // Sort all posts by date
        }
        // $posts = Post::where('user_id', auth()->id())->get(); 
        return view('post.home',compact('res'));
    }
    // @foreach($comments as $comment)
    //     @if ($post->id==$comment->post_id)
    //         @foreach ($users as $user)                                                 
    //                 @if ($comment->user_id==$user->id)
    //                     Comment of {{$user->name}}:{!! $comment->comment !!}
    //                     {{-- {!! nl2br(e($comment->comment)) !!} --}}
    //                     @foreach($comment->images as $image)
    //                     <img src="{{URL::to($image->path)}}" style="height:50px; width:50px" alt="">
    //                     @endforeach
    //                 @endif
    //             <br>
    //         @endforeach
    //     @endif
    // @endforeach
}

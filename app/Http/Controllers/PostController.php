<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Delete Post
    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){ // If you are the author of this Post
            $post->delete();
        }
        return redirect('/'); 
    }

    // Users click the Edit button and they see the Edit Post Screen
    public function showEditScreen(Post $post) {
        if(auth()->user()->id !== $post['user_id']){    // Dùng Middleware như bộ lọc
            return redirect('/');
        }
        return view('edit-post',['post' => $post]);
    }

    // Users are redirected to home page after editing their Post
    public function actuallyUpdatePost(Post $post, Request $request) {
        if(auth()->user()->id !== $post['user_id']){    // If you are not the author of this Post
            return redirect('/');
        }
        $rules = [
            'title' => 'required',
            'body' => 'required'
        ];
        $message = [
            'title.required'=>'Title is required',
            'body.required' => 'Content is required'
        ];
        $incomingFields = $request->validate($rules, $message);
        $incomingFields['title'] = strip_tags($incomingFields['title']); // strip_tags to clean tag
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return redirect('/');
    }

    // Create new Post
    public function createPost(Request $request){
        $rules = [
            'title' => 'required',
            'body' => 'required'
        ];
        $message = [
            'title.required'=>'Title is required',
            'body.required' => 'Content is required'
        ];
        $incomingFields = $request->validate($rules, $message);
        $incomingFields['title'] = strip_tags($incomingFields['title']); 
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id(); // Call the global auth for knowing who is creating post
        Post::create($incomingFields);
        return redirect('/');
    }
}

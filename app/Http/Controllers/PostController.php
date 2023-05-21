<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function apiPost(Request $request)
    {
        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => $request->get('user_id'),
        ];
        Post::create($data);
        $res = [
            'status' => 200,
            'message' => 'created ok',
        ];
        return $res;
    }

    public function getPost()
    {
        return view('new_post');
    }
    // Delete Post
    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){ // If you are the author of this Post
            $post->delete();
            return redirect('/'); 
        }
        else{
            return back()->with ('error', 'Your are not the author of this post');
        }
        
    }
    // View post
    public function showViewScreen($postId){
        $post = Post::find($postId);
        return view('view-post',['post' => $post]); // 'post' represent for $post in blade view
    }
    // Users click the Edit button and they see the Edit Post Screen
    public function showEditScreen(Post $post) {
        if(auth()->user()->id !== $post['user_id']){    // If you are the author of this Post
            return back()->with ('error', 'Your are not the author of this post');
        }
        else{
            return view('edit-post',['post' => $post]); 
        }
        
    }

    // Update comment
    public function comment(Post $post, Request $request){
        $rules = [
            'comment' => 'required'
        ];
        $message = [
            'comment.required'=>'Comment is required'
        ];
        $incomingFields = $request->validate($rules, $message);
        $incomingFields['post_id'] = $post['id'];
        $incomingFields['user_id'] = auth()->id();
        $incomingFields['comment'] = strip_tags($incomingFields['comment']);
        Comment::create($incomingFields);
        return redirect('/');
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
        $image = array();
        if($files = $request->file('image')){
            foreach ($files as $file){
                $image_name = md5(rand(100,1000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'storage/multiple_image/';
                $image_url = $upload_path.$image_full_name;
                $file->move($upload_path, $image_full_name);
                $image[] = $image_url;
            }
        }
        $incomingFields['image'] = implode('|',$image);
        Post::create($incomingFields);
        return redirect('/')->with('success','Post created successfully');
    }
}

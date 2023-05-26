<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
    public function deletePost(Post $post, Image $image){
        if(auth()->user()->id === $post['user_id']){ // If you are the author of this Post
            $names = Image::select('name')->where('post_id',$post->id)->get();
            foreach($names as $name){
                // dd($name->name);
                Storage::disk('public')->delete($name->name);
            }
            $post->delete();
            return redirect('/'); 
        }
        else{
            return back()->with ('error', 'Your are not the author of this post');
        }
        
    }
    // View post
    public function showViewScreen($postId){
        $images = Image::all();
        $post = Post::find($postId);
        return view('view-post',compact('post','images')); // 'post' represent for $post in blade view
    }

    // Edit image
    public function showEditImage($postId){
        $images = Image::all();
        $post = Post::find($postId);
        return view('edit-image',compact('post','images')); // 'post' represent for $post in blade view
    }

    // Edit Post Screen
    public function showEditScreen(Post $post) {
        $images = Image::all();
        if(auth()->user()->id !== $post['user_id']){    // If you are the author of this Post
            return back()->with ('error', 'Your are not the author of this post');
        }
        else{
            return view('edit-post',compact('post','images')); 
        }
        
    }

    // Comment
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


    // Updating Post
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
        // $image = array();
        Post::create($incomingFields);
        if($files = $request->file('image')){ // Nếu file upload là file ảnh
            foreach ($files as $file){
                $image_name = md5(rand(100,1000));
                $ext = strtolower($file->getClientOriginalExtension()); // Lấy đuôi cuối của file .png
                $image_full_name = $image_name.'.'.$ext;
                // $upload_path = 'storage/multiple_image/';
                // $image_url = $upload_path.$image_full_name;
                // $file->move($upload_path, $image_full_name);
                // $image[] = $image_url;
                Storage::disk('public')->put( $image_full_name, file_get_contents($file) );
                $imageFields['post_id'] = Post::max('id');
                $imageFields['path'] = Storage::url($image_full_name);
                $imageFields['name'] = $image_full_name;
                // dd($imageFields['path']);
                Image::create($imageFields);
            }
        }
        // $image = DB::table('posts')->where('id',$post->id)->first();
        // $images = explode('|', $image->image);
        return redirect('/')->with('success','Post created successfully');
    }

    // Delete Image
    public function deleteImage(Image $image){
        // dd($image->name);
        Storage::disk('public')->delete($image->name);
        $image->delete();
        return back();
    }

    // Add image
    public function addImage(Request $request, $Id){ // Id is taken from Route '/add-image/{id}'
        if($files = $request->file('image')){ // Nếu file upload là file ảnh
            foreach ($files as $file){
                $image_name = md5(rand(100,1000));
                $ext = strtolower($file->getClientOriginalExtension()); // Lấy đuôi cuối của file .png
                $image_full_name = $image_name.'.'.$ext;
                Storage::disk('public')->put( $image_full_name, file_get_contents($file) );
                $imageFields['post_id'] = $Id;
                $imageFields['path'] = Storage::url($image_full_name);
                $imageFields['name'] = $image_full_name;
                Image::create($imageFields);
            }
        }
        return redirect('/');
    }
    // Update image
    public function editImage(Request $request, $image_id) {
        $image = Image::find($image_id);
        // dd($image->name);
        Storage::disk('public')->delete($image->name);
        if($file = $request->file('image')){
            $image_name = md5(rand(100,1000));
            $ext = strtolower($file->getClientOriginalExtension()); // Lấy đuôi cuối của file .png
            $image_full_name = $image_name.'.'.$ext;
            Storage::disk('public')->put( $image_full_name, file_get_contents($file) );
            $image->path = Storage::url($image_full_name);
            $image->name = $image_full_name;
            $image->update();
        }
        else return back();
        return back();
    }
}



    
    
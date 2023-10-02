<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\NewPostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\CommentPostRequest;
use App\Http\Requests\UpdateImageRequest;


class PostController extends Controller
{

    public function getPost()
    {
        return view('post.new_post');
    }
    
    // Delete Post
    public function deletePost(Post $post, Image $image)
    {
        if(auth()->user()->id === $post['user_id']){ // If you are the author of this Post
            $names = Image::select('name')->where('imageable_id',$post->id)->get();
            foreach($names as $name){
                Storage::disk('public')->delete($name->name);
            }
            DB::table('images')->where('imageable_id',$post->id)->delete();
            $post->delete();
            return redirect('/home'); 
        }
        else{
            return back()->with ('error', 'Your are not the author of this post');
        }
        
    }
    // View post
    public function showViewScreen($postId){
        $post = Post::find($postId);
        $images = $post->images;

        return view('post.view_post',compact('post','images'));
    }

    // Edit image
    public function showEditImage($postId)
    {
        $images = Image::all();
        $post = Post::find($postId);

        return view('post.edit-image',compact('post','images'));
    }

    // Edit Post Screen
    public function showEditScreen(Post $post, $Id) 
    {
        $post = Post::find($Id);
        $images = $post->images;
        if(auth()->user()->id !== $post['user_id']){
            return back()->with ('error', 'Your are not the author of this post');
        }
        else{
            return view('post.edit_post',compact('post','images')); 
        }
    }

    // Comment
    public function comment(Post $post, CommentPostRequest $request, $Id)
    {
        Comment::create($request->validated()+[
            'post_id' => $Id,
            'user_id' => auth()->id()
        ]);
        if($files = $request->file('images')){
            foreach ($files as $file){
                $image = Image::createImage($file);
                $comment = Comment::find(Comment::max('id'));
                $comment->images()->save($image);
            }
        }

        return redirect('/home');
        // return back();
    }


    // Updating Post
    public function actuallyUpdatePost(Post $post, UpdatePostRequest $request) 
    {
        $post->update($request->validated());

        return redirect('/home');
    }

    // Create new Post
    public function createPost(NewPostRequest $request)
    {
        Post::create($request->validated()+[
            'user_id' => auth()->id()
        ]);
        if($files = $request->file('images')){
            foreach ($files as $file){
                $image = Image::createImage($file);
                $post = Post::find(Post::max('id'));
                $post->images()->save($image);
            }
        }

        return redirect('/home')->with('success','Post created successfully');
    }

    // Delete Image
    public function deleteImage(Image $image)
    {
        Storage::disk('public')->delete($image->name);
        $image->delete();

        return back();
    }

    // Add image
    public function addImage(Request $request, $Id) // Id is taken from Route '/add-image/{id}'    
    { 
        if($files = $request->file('images')){
            foreach ($files as $file){
                $image = Image::createImage($file);
                $post = Post::find($Id);
                $post->images()->save($image);
            }
        }

        return redirect('/home');
    }

    // Update image
    public function editImage(UpdateImageRequest $request, $image_id) 
    {
        $request->validated();
        if($file = $request->file('image')){
            Image::updateImage($file,$image_id)->update();

            return redirect('/home');
        }
    }
    
    function postSearch(Request $request)
    {
        $res = Post::fullPostArray($request);
        
        return view('post.home',compact('res'));
    }

    // Home page
    public function home (Request $request) 
    {
        if(auth()->check()){
            $res = Post::fullPostArray($request);
        }

        return view('post.home',compact('res'));
    }
}

// $posts = Post::all();
            // $data = Post::join('comments', 'comments.post_id', '=', 'posts.id')
            //     ->join('users', 'comments.user_id', '=', 'users.id')
            //     ->rightjoin('posts as p', 'p.id', '=', 'comments.post_id')
            //     ->select('p.title as title', 'p.body as content', 'comments.comment as comment', 'users.name as username', 'p.id as post_id')
            //     // ->paginate(2);
            //     ->get();

            // foreach($data as $value) {
            //     if (!empty($res[$value['post_id']] )) {
            //         $res[$value['post_id']] = [
            //             'title' => $value['title'],
            //             'comment' => $res[$value['post_id']]['comment'] .'\n' . $value['username'] .': ' .$value['content'],
            //             'content' => $value['content'],
            //         ];
            //     } else {
            //         $res[$value['post_id']] = [
            //             'title' => $value['title'],
            //             'content' => $value['username'] .': ' .$value['content'],
            //             'comment' => $value['title'],
            //         ];
            //     }    
            // }



    
    